<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes;
use App\Subject;
use App\User;
use App\ClassesSubject;
use App\ClassesStudent;
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
        
        return view('admin.classes.create')
            ->with('page_name', 'Create Class');
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
        
        return view('admin.classes.edit')
            ->with('page_name', 'Edit Class')
            ->with('page_description', '(id:'.$data->id.')')
            ->with('data', $data);
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
            $data->update($input);
            
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
        $subjects = Subject::get();
        $teachers = User::where('type', 'teacher')->get();
        
        
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

        if (empty($validator) || $validator->fails()) {
            $response['notifMessage'] = 'Failed request.';
            $response['message'] = ['Check required fields.'];
            $status = 422;
        } else {
            foreach ($subjects as $key => $subject) {
                if (empty($subject['action'])) {
                    $data = ClassesSubject::create($subject);
                } else if ($subject['action'] == 'edit') {
                    $data = ClassesSubject::find($subject['id']);
                    $data->update($input);
                } else if ($subject['action'] == 'delete') {
                    ClassesSubject::destroy($input['id']);
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
        $students = User::where('type', 'student')->get();
        
        
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
                        'student_id' => 'required|integer',
                    ]);
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
                    $data = ClassesStudent::create($subject);
                } else if ($subject['action'] == 'edit') {
                    $data = ClassesStudent::find($subject['id']);
                    $data->update($input);
                } else if ($subject['action'] == 'delete') {
                    ClassesStudent::destroy($input['id']);
                }
            }
            
            $response['notifMessage'] = 'Update request saved.';
            $response['redirect'] = route('ManageClassStudent', [$id]);
            $status = 201;
        }

        return response($response, $status);
    }
}
