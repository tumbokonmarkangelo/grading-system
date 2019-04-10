<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ClassesSubject;
use App\Computation;
use App\Grade;
use Validator;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        if (!empty($input['subject'])) {
            $data = ClassesSubject::find($input['subject']);
            $students = $data->class->students;
        }
        
        $subjects = new ClassesSubject;
        if ($user->type == 'teacher') {
            $subjects = $subjects->where('teacher_id', $user->id);
            $subjects = $subjects->whereHas('class', function ($query) use ($user) {
                $query->where('status', 'active');
            });
        }
        $subjects = $subjects->orderBy('id', 'desc')->get();

        return view('admin.grades.index')
            ->with('page_name', 'Manage Grades')
            ->with('data', @$data)
            ->with('students', @$students)
            ->with('period', @$input['period'])
            ->with('subjects', $subjects);
    }

    public function assign(Request $request, $id)
    {
        $input = $request->except('computations');
        $computations = $request->only('computations')['computations'];
        
        $input['computed_grade'] = 0;
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

        $validator = Validator::make($input, [
            'classes_subject_id' => 'required|integer',
            'student_id' => 'required|integer',
            'computed_grade' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $response['notifMessage'] = 'Failed request.';
            $response['message'] = $validator->errors()->all();
            $status = 422;
        } else {
            $data = Grade::where('classes_subject_id', $input['classes_subject_id'])->where('student_id', $input['student_id'])->first();
            if ($data) {
                $data->update($input);
                $data->items()->delete();
            } else {
                $data = Grade::create($input);
            }
            foreach ($grade_item as $key => $item) {
                $data->items()->create($item);
            }
            
            $response['notifMessage'] = 'Saved request.';
            // $response['resetForm'] = true;
            // $response['redirect'] = route('ClassesManagement');
            $status = 201;
        }

        return response($response, $status);
    }
}
