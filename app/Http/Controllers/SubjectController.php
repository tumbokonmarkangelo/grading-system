<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Subject;
use App\Semester;
use App\YearLevel;
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
        $semesters = Semester::get();
        $year_levels = YearLevel::get();
        
        return view('admin.subjects.create')
            ->with('page_name', 'Create Subject')
            ->with('semesters', $semesters)
            ->with('year_levels', $year_levels);
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
        $semesters = Semester::get();
        $year_levels = YearLevel::get();
        
        return view('admin.subjects.edit')
            ->with('page_name', 'Edit Subject')
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
