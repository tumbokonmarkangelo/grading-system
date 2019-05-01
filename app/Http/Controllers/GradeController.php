<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes;
use App\ClassesSubject;
use App\ClassesStudent;
use App\Computation;
use App\Semester;
use App\YearLevel;
use App\Grade;
use App\User;
use Validator;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        if (!empty($input['subject'])) {
            $data = ClassesSubject::find($input['subject']);
            $students = $data->class->students()->whereDoesntHave('grades', function ($query) use ($data) {
                $query->where('classes_subject_id', $data->id)->where('remarks', 'drop')->where('period', null);
            })->get();
        }
        
        $subjects = new ClassesSubject;
        if ($user->type == 'teacher') {
            $subjects = $subjects->where('teacher_id', $user->id);
            $subjects = $subjects->whereHas('class', function ($query) use ($user) {
                $query->where('status', 'active');
            });
            $page_name = 'Manage Grades';
        }
        if ($user->type == 'admin') {
            $subjects = $subjects->whereHas('class', function ($query) use ($user) {
                $query->where('status', 'archive');
            });
            $page_name = 'Manage Grades(Archived Classes)';
        }
        $subjects = $subjects->orderBy('id', 'desc')->get();

        return view('admin.grades.index')
            ->with('page_name', $page_name)
            ->with('data', @$data)
            ->with('students', @$students)
            ->with('period', @$input['period'])
            ->with('subjects', $subjects);
    }

    public function assign(Request $request, $id)
    {
        $input = $request->except('computations');
        $input['computed_grade'] = '0';
        if (@$input['remarks'] == 'drop') {
            Grade::where('classes_subject_id', $input['classes_subject_id'])->where('student_id', $input['student_id'])->whereIn('period', ['prelim', 'midterm', 'final'])->delete();
            $response['redirect'] = route('GradesManagement', ['subject' => $input['classes_subject_id'], 'period' => @$input['period']]);
            $input['period'] = null;
        } else {
            Grade::where('classes_subject_id', $input['classes_subject_id'])->where('student_id', $input['student_id'])->where('period', null)->where('remarks', 'drop')->forceDelete();
            
            $computations = $request->only('computations')['computations'];
            $grade_item;
            foreach ($computations as $computation_id => $value) {
                $computation = Computation::find($computation_id);
                $grade_item[] = ['value' => $value,
                                'computation_id' => $computation_id,
                                'computation_name' => $computation->name,
                                'computation_description' => $computation->description,
                                'computation_value' => $computation->value
                            ];
                $computation_item[] = doubleval($value) * doubleval('0.'.$computation->value);
                $input['computed_grade'] += doubleval($value) * doubleval('0.'.$computation->value);
            }
        }

        $validator = Validator::make($input, [
            'classes_subject_id' => 'required|integer',
            'student_id' => 'required|integer',
            'computed_grade' => 'required|numeric',
            'period' => 'nullable|in:prelim,midterm,final',
        ]);

        if ($validator->fails()) {
            $response['notifMessage'] = 'Failed request.';
            $response['message'] = $validator->errors()->all();
            $status = 422;
        } else {
            $data = Grade::where('classes_subject_id', $input['classes_subject_id'])->where('student_id', $input['student_id'])->where('period', $input['period'])->first();
            
            if ($data) {
                $activity['value_from'] = json_encode($data);
                $data->update($input);
                $activity['value_to'] = json_encode($data);
    
                $user = Auth::user();
                $activity['user_id'] = $user->id;
                $activity['log'] = $user->name . ' update grade assigned for ' . $data->student->name . '.';
                $data->activities()->create($activity);
                $data->items()->delete();
            } else {
                $data = Grade::create($input);
                $activity['value_to'] = json_encode($data);
    
                $user = Auth::user();
                $activity['user_id'] = $user->id;
                $activity['log'] = $user->name . ' assign grade for ' . $data->student->name . '.';
                $data->activities()->create($activity);
            }
            if (!empty($grade_item)) {
                foreach ($grade_item as $key => $item) {
                    $data->items()->create($item);
                }
            }
            
            $response['notifMessage'] = 'Saved request.';
            $status = 201;
        }

        return response($response, $status);
    }
    
    public function view(Request $request)
    {
        $semesters = Semester::get();
        $year_levels = YearLevel::get();

        $user = Auth::user();
        $input = $request->all();
        $classes = new Classes;
        if ($user->type == 'student') {
            $classes = $classes->whereHas('students', function ($query) use ($user) {
                $query->where('student_id', $user->id);
            });
            $grades = Grade::where('student_id', $user->id)->get();
        } else if ($user->type == 'teacher') {
            $classes = $classes->whereHas('subjects', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            });
        }
        $classes = $classes->get();

        $data = @$classes[0];
        if (!empty($input['class_id'])) {
            $data = $data->find($input['class_id']);
        }

        if ($user->type == 'teacher') {
            $data->subjects = $data->subjects->where('teacher_id', $user->id);
        }

        $subject = @$data->subjects[0];
        if (!empty($input['classes_subject_id'])) {
            $subject = $data->subjects->find($input['classes_subject_id']);
        }
        
        return view('admin.grades.view')
            ->with('page_name', 'View Grades')
            ->with('grades', @$grades)
            ->with('data', @$data)
            ->with('subject', @$subject)
            ->with('classes', @$classes)
            ->with('class_id', @$input['class_id'])
            ->with('print', !empty($input['print']) ? $input['print'] : 0)
            ->with('semesters', $semesters)
            ->with('year_levels', $year_levels)
            ->with('user', $user);
    }
    
    public function overall(Request $request, $username = '')
    {
        $user = Auth::user();
        $input = $request->all();
        $username = !empty($input['username']) ? $input['username'] : $username;
        if ($user->type == 'student') {
            $student = $user;
        } else if (!empty($username)) {
            $student = User::where('username', $username)->first();
        }

        $students = User::whereHas('grades')->get();

        if (isset($student)) {
            $classes_id = Classes::whereHas('students', function ($query) use ($student) {
                $query->where('student_id', $student->id);
            })->pluck('id');

            $subjects = ClassesSubject::whereIn('class_id', $classes_id)->get();

            // $subjects = [];
            // foreach ($classes as $key => $class) {
            //     $subjects = array_merge((array) $subjects, $class->subjects->toArray());
            // }
        }
        $semesters = Semester::get();
        $year_levels = YearLevel::get();

        return view('admin.grades.overall')
            ->with('page_name', 'View Grades')
            ->with('students', @$students)
            ->with('classes', @$classes)
            ->with('student', @$student)
            ->with('subjects', @$subjects)
            ->with('username', @$username)
            ->with('print', !empty($input['print']) ? $input['print'] : 0)
            ->with('semesters', @$semesters)
            ->with('year_levels', @$year_levels)
            ->with('user', $user);
    }
    
    public function class_record(Request $request)
    {
        $semesters = Semester::get();
        $year_levels = YearLevel::get();

        $user = Auth::user();
        $input = $request->all();
        $classes = new Classes;
        if ($user->type == 'student') {
            $classes = $classes->whereHas('students', function ($query) use ($user) {
                $query->where('student_id', $user->id);
            });
            $grades = Grade::where('student_id', $user->id)->get();
        } else if ($user->type == 'teacher') {
            $classes = $classes->whereHas('subjects', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            });
        }
        $classes = $classes->get();

        $data = $classes[0];
        if (!empty($input['class_id'])) {
            $data = $data->find($input['class_id']);
        }

        if ($user->type == 'teacher') {
            $data->subjects = $data->subjects->where('teacher_id', $user->id);
        }

        $subject = @$data->subjects[0];
        if (!empty($input['classes_subject_id'])) {
            $subject = $data->subjects->find($input['classes_subject_id']);
        }
        
        return view('admin.grades.class-record')
            ->with('page_name', 'View Class Record')
            ->with('grades', @$grades)
            ->with('data', @$data)
            ->with('subject', @$subject)
            ->with('classes', @$classes)
            ->with('class_id', @$input['class_id'])
            ->with('print', !empty($input['print']) ? $input['print'] : 0)
            ->with('semesters', $semesters)
            ->with('year_levels', $year_levels)
            ->with('user', $user);
    }
}
