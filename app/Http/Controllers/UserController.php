<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\YearLevel;
use Validator;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $input = $request->all();
        $input_student_info = $request->only('course','year_id');

        if (empty($input['email'])) unset($input['email']);

        $user_count = User::where('type', $input['type'])->count();

        if (empty($input['username'])) {
            $prefix = Carbon::now()->format('y'); // ID Number/Username prefix for students
            if ($input['type'] == 'admin') $prefix = 'A'; // ID Number/Username prefix for admin
            if ($input['type'] == 'teacher') $prefix = 'B'; // ID Number/Username prefix for teachers
            if ($input['type'] == 'assistant') $prefix = 'C'; // ID Number/Username prefix for admin assistant
            
            $input['username'] = $prefix . '-' .sprintf("%'.04d", ($user_count + 1));
        }

        $validator = Validator::make($input, [
            'first_name' => 'required|max:191',
            'middle_name' => 'max:191',
            'last_name' => 'required|max:191',
            'email' => 'unique:users|max:191',
            'password' => 'required|max:191',
            'type' => 'required|in:admin,teacher,student,assistant',
        ]);
        

        if (!$validator->fails() && !empty($input['username'])) {
            $messages = [
                'username.required' => 'ID number field is required.',
                'username.unique' => 'ID number has already been taken.',
            ];
            $validator = Validator::make($input, [
                'username' => 'required|unique:users|max:191',
            ], $messages);
        }

        if (!$validator->fails() && !empty($input['type']) && $input['type'] == 'student') {
            $validator = Validator::make($input_student_info, [
                'course' => 'required|max:191',
                'year_id' => 'required|integer',
            ]);
        }

        if ($validator->fails()) {
            $response['notifMessage'] = 'Failed request.';
            $response['message'] = $validator->errors()->all();
            $status = 422;
        } else {
            $user = new User;
            $user->first_name = $input['first_name'];
            $user->middle_name = $input['middle_name'];
            $user->last_name = $input['last_name'];
            $user->username = $input['username'];
            $user->password = bcrypt($input['password']);
            $user->type = $input['type'];
            $user->email = !empty($input['email']) ? $input['email'] : NULL;
            $user->save();
            
            if ($user->type == 'student') {
                if ($user->student_info) {
                    $user->student_info()->update($input_student_info);
                } else {
                    $user->student_info()->create($input_student_info);
                }
            } else {
                $student_info = $user->student_info()->delete();
            }

            $activity['value_to'] = json_encode($user);

            $log_user = Auth::user();
            $activity['user_id'] = $log_user->id;
            $activity['log'] = $log_user->name . ' create new user.';
            $log_user->activities()->create($activity);
            
            $response['notifMessage'] = 'Saved request.';
            $response['resetForm'] = true;
            $response['redirect'] = route('UsersManagement');
            $status = 201;
        }

        return response($response, $status);
    }

    public function edit($id)
    {
        $user = Auth::user();
        $data = User::find($id);
        $year_levels = YearLevel::get();

        if (!empty($data->student_info)) {
            $data->course = $data->student_info->course;
            $data->year_id = $data->student_info->year_id;
        }
        
        return view('admin.users.edit')
            ->with('page_name', 'Edit User')
            ->with('page_description', $data->updated_at ? '(last update: '.$data->updated_at->diffForHumans().')' : '')
            ->with('year_levels', $year_levels)
            ->with('data', $data)
            ->with('user', $user);
    }

    public function profile()
    {
        $user = Auth::user();
        $year_levels = YearLevel::get();

        if (!empty($user->student_info)) {
            $user->course = $user->student_info->course;
            $user->year_level = $user->student_info->year_level;
        }
        
        return view('admin.users.profile')
            ->with('page_name', 'Profile')
            ->with('year_levels', $year_levels)
            ->with('user', $user);
    }

    public function manage_profile()
    {
        $user = Auth::user();
        $year_levels = YearLevel::get();

        if (!empty($user->student_info)) {
            $user->course = $user->student_info->course;
            $user->year_id = $user->student_info->year_id;
        }
        
        return view('admin.users.edit')
            ->with('page_name', 'Manage Profile')
            ->with('year_levels', $year_levels)
            ->with('data', $user)
            ->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        $input = $request->except('id','course','year_id');
        $input_student_info = $request->only('course','year_id');

        if (empty($input['email'])) unset($input['email']);
        
        $user = User::find($id);

        $validator = Validator::make($input, [
            'first_name' => 'required|max:191',
            'middle_name' => 'max:191',
            'last_name' => 'required|max:191',
            'email' => $user->email == $input['email'] ? '' : 'unique:users|' .'max:191',
            'username' => 'max:191',
            'password' => 'max:191',
            'type' => 'required|in:admin,teacher,student,assistant',
        ]);

        if (!$validator->fails() && !empty($input['username']) && $user->username !== $input['username']) {
            $messages = [
                'username.required' => 'ID number field is required.',
                'username.unique' => 'ID number has already been taken.',
            ];
            $validator = Validator::make($input, [
                'username' => 'required|unique:users|max:191',
            ], $messages);
        }

        if (!$validator->fails() && !empty($input['type']) && $input['type'] == 'student') {
            $validator = Validator::make($input_student_info, [
                'course' => 'required|max:191',
                'year_id' => 'required|integer',
            ]);
        }

        if ($validator->fails()) {
            $response['notifMessage'] = 'Failed request.';
            $response['message'] = $validator->errors()->all();
            $status = 422;
        } else {
            $activity['value_from'] = json_encode($user);
            
            $user->first_name = $input['first_name'];
            $user->middle_name = $input['middle_name'];
            $user->last_name = $input['last_name'];
            if (!empty($input['username'])) $user->username = $input['username'];
            $user->password = bcrypt($input['password']);
            $user->type = $input['type'];
            $user->email = !empty($input['email']) ? $input['email'] : NULL;
            $user->update();

            if ($user->type == 'student') {
                if ($user->student_info) {
                    $user->student_info()->update($input_student_info);
                } else {
                    $user->student_info()->create($input_student_info);
                }
            } else {
                $student_info = $user->student_info()->delete();
            }
            
            $activity['value_to'] = json_encode($user);

            $log_user = Auth::user();
            $activity['user_id'] = $log_user->id;
            $activity['log'] = $log_user->name . ' update existing user.';
            $log_user->activities()->create($activity);
            $response['notifMessage'] = 'Update request saved.';
            $response['redirect'] = route('EditUser', $user->id);
            if ($user->id == $log_user->id) {
                $response['redirect'] = route('UserProfile');
            }
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
            $data = User::find($input['id']);
            $activity['value_from'] = json_encode($data);
            $user = Auth::user();
            $activity['user_id'] = $user->id;
            $activity['log'] = $user->name . ' delete user.';
            $data->activities()->create($activity);
            User::destroy($input['id']);
            
            $response['notifMessage'] = 'Deletion request complete.';
            $response['redirect'] = route('UsersManagement');
            $status = 201;
        }

        return response($response, $status);
    }

}
