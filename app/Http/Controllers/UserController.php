<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;

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

        if (empty($input['email'])) unset($input['email']);

        $validator = Validator::make($input, [
            'first_name' => 'required|max:191',
            'middle_name' => 'max:191',
            'last_name' => 'required|max:191',
            'email' => 'unique:users|max:191',
            'username' => 'required|unique:users|max:191',
            'password' => 'required|max:191',
            'type' => 'required|in:admin,teacher,student',
        ]);

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
            
            $response['notifMessage'] = 'Save successful.';
            $response['resetForm'] = true;
            $response['redirect'] = route('UsersManagement');
            $status = 201;
        }

        return response($response, $status);
    }

}
