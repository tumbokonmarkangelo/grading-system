<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes;
use App\Subject;
use App\User;
use App\ClassesSubject;
use App\ClassesStudent;
use App\Semester;
use App\YearLevel;
use App\Computation;
use App\Grade;
use Validator;

class ClassController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $semesters = Semester::get();
        $year_levels = YearLevel::get();

        return view('admin.classes.create')
            ->with('page_name', 'Create Class')
            ->with('semesters', $semesters)
            ->with('year_levels', $year_levels);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'code' => 'required|max:191',
            'semester_id' => 'integer',
            'year_id' => 'integer',
        ]);

        if ($validator->fails()) {
            $response['notifMessage'] = 'Failed request.';
            $response['message'] = $validator->errors()->all();
            $status = 422;
        } else {
            $data = Classes::create($input);
            $activity['value_to'] = json_encode($data);


            $user = Auth::user();
            $activity['user_id'] = $user->id;
            $activity['log'] = $user->name . ' create new class.';
            $data->activities()->create($activity);
            
            $response['notifMessage'] = 'Saved request.';
            $response['resetForm'] = true;
            $response['redirect'] = route('ClassesManagement');
            $status = 201;
        }

        return response($response, $status);
    }

    public function edit($id)
    {
        $data = Classes::find($id);
        $semesters = Semester::get();
        $year_levels = YearLevel::get();
        
        return view('admin.classes.edit')
            ->with('page_name', 'Edit Class')
            ->with('page_description', $data->updated_at ? '(last update: '.$data->updated_at->diffForHumans().')' : '')
            ->with('data', $data)
            ->with('semesters', $semesters)
            ->with('year_levels', $year_levels);
    }

    public function update(Request $request, $id)
    {
        $input = $request->except('id');

        $validator = Validator::make($input, [
            'code' => 'required|max:191',
            'semester_id' => 'integer',
            'year_id' => 'integer',
        ]);

        if ($validator->fails()) {
            $response['notifMessage'] = 'Failed request.';
            $response['message'] = $validator->errors()->all();
            $status = 422;
        } else {
            $data = Classes::find($id);
            $activity['value_from'] = json_encode($data);
            $data->update($input);
            $activity['value_to'] = json_encode($data);

            $user = Auth::user();
            $activity['user_id'] = $user->id;
            $activity['log'] = $user->name . ' update existing class.';
            $data->activities()->create($activity);
            
            $response['notifMessage'] = 'Update request saved.';
            $status = 201;
        }

        return response($response, $status);
    }

    public function delete(Request $request)
    {
        $input = $request->all();
        
        if (empty($input['id'])) {
            $response['notifMessage'] = 'Failed request.';
            $status = 422;
        } else {
            $data = Classes::find($input['id']);
            $activity['value_from'] = json_encode($data);
            $user = Auth::user();
            $activity['user_id'] = $user->id;
            $activity['log'] = $user->name . ' delete class.';
            $data->activities()->create($activity);

            Classes::destroy($input['id']);
            
            $response['notifMessage'] = 'Deletion request complete.';
            $response['redirect'] = route('ClassesManagement');
            $status = 201;
        }

        return response($response, $status);
    }


    public function manage_subject($id)
    {
        $data = Classes::find($id);
        if (!empty($user = Auth::user()) && $user->type == 'teacher') { 
            $data->subjects = $data->subjects->where('teacher_id', $user->id);
        }
        $subjects = Subject::orderBy('code', 'asc')->get();
        $teachers = User::where('type', 'teacher')->orderBy('first_name', 'asc')->get();
        
        
        return view('admin.classes.manage.subjects')
            ->with('page_name', 'Edit Class Subjects')
            ->with('page_description', '(Class code: '.$data->code.')')
            ->with('subjects', $subjects)
            ->with('teachers', $teachers)
            ->with('data', $data)
            ->with('json_data', json_encode($data));
    }

    public function update_subject(Request $request, $id)
    {
        $input = $request->all();

        if (!empty($input['id'])) {
            $subjects;
            foreach ($input['id'] as $key => $subject_id) {
                foreach ($input as $key_name => $value) {
                    if (!empty($value[$key])) {
                        $subjects[$key][$key_name] = $value[$key];
                    }
                }
            }
            
            foreach ($subjects as $key => $subject) {
                if (empty($validator) || !$validator->fails()) {
                    if (!empty($subject['action']) && $subject['action'] == 'delete') {
                        $validator = Validator::make($subject, [
                            'id' => 'required|integer',
                        ]);
                    } else {
                        $validator = Validator::make($subject, [
                            'class_id' => 'required|integer',
                            'subject_id' => 'required|integer',
                            'teacher_id' => 'required|integer',
                        ]);
                    }
                }
            }
        }

        if (empty($validator) || $validator->fails()) {
            $response['notifMessage'] = 'Failed request.';
            $response['message'] = ['Check required fields.'];
            $status = 422;
        } else {
            foreach ($subjects as $key => $subject) {
                if (empty($subject['action'])) {
                    $data = ClassesSubject::create($subject);
                    $computation_template = Computation::where('classes_subject_id', 0)->get();
                    foreach ($computation_template as $key => $computation) {
                        $data->computations()->create($computation->toArray());
                        $activity['value_to'] = json_encode($data);
            
                        $user = Auth::user();
                        $activity['user_id'] = $user->id;
                        $activity['log'] = $user->name . ' create new class subject.';
                        $data->activities()->create($activity);
                    }
                } else if ($subject['action'] == 'edit') {
                    $data = ClassesSubject::find($subject['id']);
                    $activity['value_from'] = json_encode($data);
                    $data->update($subject);
                    $activity['value_to'] = json_encode($data);
        
                    $user = Auth::user();
                    $activity['user_id'] = $user->id;
                    $activity['log'] = $user->name . ' update existing class subject.';
                    $data->activities()->create($activity);
                } else if ($subject['action'] == 'delete') {
                    $data = ClassesSubject::find($subject['id']);
                    $activity['value_from'] = json_encode($data);
                    $user = Auth::user();
                    $activity['user_id'] = $user->id;
                    $activity['log'] = $user->name . ' delete class.';
                    $data->activities()->create($activity);
                    ClassesSubject::destroy($subject['id']);
                }
            }
            
            $response['notifMessage'] = 'Update request saved.';
            $response['redirect'] = route('ManageClassSubject', [$id]);
            $status = 201;
        }

        return response($response, $status);
    }

    public function manage_student($id)
    {
        $data = Classes::find($id);
        $students = User::where('type', 'student')->orderBy('first_name', 'asc')->get();
        
        
        return view('admin.classes.manage.students')
            ->with('page_name', 'Edit Class Subjects')
            ->with('page_description', '(Class code: '.$data->code.')')
            ->with('students', $students)
            ->with('data', $data)
            ->with('json_data', json_encode($data));
    }

    public function update_student(Request $request, $id)
    {
        $input = $request->all();

        if (!empty($input['id'])) {
            $students;
            foreach ($input['id'] as $key => $student_id) {
                foreach ($input as $key_name => $value) {
                    if (!empty($value[$key])) {
                        $students[$key][$key_name] = $value[$key];
                    }
                }
            }
            
            foreach ($students as $key => $student) {
                if (empty($validator) || !$validator->fails()) {
                    if (!empty($student['action']) && $student['action'] == 'delete') {
                        $validator = Validator::make($student, [
                            'id' => 'required|integer',
                        ]);
                    } else {
                        $validator = Validator::make($student, [
                            'class_id' => 'required|integer',
                            'student_id' => 'required|integer',
                        ]);
                    }
                }
            }
        }

        if (empty($validator) || $validator->fails()) {
            $response['notifMessage'] = 'Failed request.';
            $response['message'] = ['Check required fields.'];
            $status = 422;
        } else {
            foreach ($students as $key => $student) {
                if (empty($student['action'])) {
                    $data = ClassesStudent::create($student);
                    $activity['value_to'] = json_encode($data);
        
                    $user = Auth::user();
                    $activity['user_id'] = $user->id;
                    $activity['log'] = $user->name . ' create new class subject.';
                    $data->activities()->create($activity);
                } else if ($student['action'] == 'edit') {
                    $data = ClassesStudent::find($student['id']);
                    $activity['value_from'] = json_encode($data);
                    $data->update($student);
                    $activity['value_to'] = json_encode($data);
        
                    $user = Auth::user();
                    $activity['user_id'] = $user->id;
                    $activity['log'] = $user->name . ' update existing class subject.';
                    $data->activities()->create($activity);
                } else if ($student['action'] == 'delete') {
                    $data = ClassesSubject::find($student['id']);
                    $activity['value_from'] = json_encode($data);
                    $user = Auth::user();
                    $activity['user_id'] = $user->id;
                    $activity['log'] = $user->name . ' delete class.';
                    $data->activities()->create($activity);
                    ClassesStudent::destroy($student['id']);
                }
            }
            
            $response['notifMessage'] = 'Update request saved.';
            $response['redirect'] = route('ManageClassStudent', [$id]);
            $status = 201;
        }

        return response($response, $status);
    }

    public function manage_subject_computaion(Request $request, $id)
    {
        $data = ClassesSubject::find($id);
        $period = !empty($request['period']) ? $request['period'] : 'prelim';
        $grade_count = Grade::where('classes_subject_id', $id)->count();
        
        return view('admin.classes.manage.computation')
            ->with('page_name', 'Edit Subject Computation')
            ->with('page_description', '(Class code: '.$data->subject->code.' - '.$data->subject->description. (!empty($period) ? ' - ' . ucfirst($period) . ' period' : '').')')
            ->with('data', $data)
            ->with('json_data', json_encode($data))
            ->with('period', $period)
            ->with('grade_count', $grade_count);
    }

    public function update_subject_computaion(Request $request, $id)
    {
        $input = $request->all();
        $period = !empty($request['period']) ? $request['period'] : 'prelim';

        if (!empty($input['id'])) {
            $items;
            foreach ($input['id'] as $key => $item_id) {
                foreach ($input as $key_name => $value) {
                    if (!empty($value[$key])) {
                        $items[$key][$key_name] = $value[$key];
                    }
                }
            }
            
            foreach ($items as $key => $item) {
                if (empty($validator) || !$validator->fails()) {
                    if (!empty($item['action']) && $item['action'] == 'delete') {
                        $validator = Validator::make($item, [
                            'id' => 'required|integer',
                        ]);
                    } else {
                        $validator = Validator::make($item, [
                            'classes_subject_id' => 'required|integer',
                            'name' => 'required|max:191',
                            'description' => 'max:191',
                            'value' => 'required|integer',
                            'period' => 'required|in:prelim,midterm,final',
                        ]);
                    }
                }
            }
        }

        if (empty($validator) || $validator->fails()) {
            $response['notifMessage'] = 'Failed request.';
            $response['message'] = ['Check required fields.'];
            $status = 422;
        } else {
            foreach ($items as $key => $item) {
                if (empty($item['action'])) {
                    $data = Computation::create($item);
                } else if ($item['action'] == 'edit') {
                    $data = Computation::find($item['id']);
                    $data->update($item);
                } else if ($item['action'] == 'delete') {
                    Computation::destroy($item['id']);
                }
            }
            
            $response['notifMessage'] = 'Update request saved.';
            $response['redirect'] = route('ManageClassSubjectComputaion', [$id]);
            $status = 201;
        }

        return response($response, $status);
    }
}
