<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes;
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

}
