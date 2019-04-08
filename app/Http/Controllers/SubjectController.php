<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Subject;
use Validator;

class SubjectController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        
        return view('admin.subjects.create')
            ->with('page_name', 'Create Subject');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'code' => 'required|max:191',
            'description' => 'max:191',
            'semester_id' => 'integer',
            'year_id' => 'integer',
        ]);

        if ($validator->fails()) {
            $response['notifMessage'] = 'Failed request.';
            $response['message'] = $validator->errors()->all();
            $status = 422;
        } else {
            $data = Subject::create($input);
            
            $response['notifMessage'] = 'Saved request.';
            $response['resetForm'] = true;
            $response['redirect'] = route('SubjectsManagement');
            $status = 201;
        }

        return response($response, $status);
    }

    public function edit($id)
    {
        $data = Subject::find($id);
        
        return view('admin.subjects.edit')
            ->with('page_name', 'Edit Subject')
            ->with('data', $data);
    }

    public function update(Request $request, $id)
    {
        $input = $request->except('id');

        $validator = Validator::make($input, [
            'code' => 'required|max:191',
            'description' => 'max:191',
            'semester_id' => 'integer',
            'year_id' => 'integer',
        ]);

        if ($validator->fails()) {
            $response['notifMessage'] = 'Failed request.';
            $response['message'] = $validator->errors()->all();
            $status = 422;
        } else {
            $data = Subject::find($id);
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
            Subject::destroy($input['id']);
            
            $response['notifMessage'] = 'Deletion request complete.';
            $response['redirect'] = route('SubjectsManagement');
            $status = 201;
        }

        return response($response, $status);
    }

}
