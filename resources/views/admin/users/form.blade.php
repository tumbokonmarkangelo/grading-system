<h5>Login Credentials</h5>
<div class="container-fluid">
    @if (!empty($user->type) && $user->type == 'admin' && $user->id != $data->id)
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="type">User Type</label>
                <select name="type" id="type" class="form-control select-user-type">
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                    <option value="admin">Admin</option>
                    <option value="assistant">Assistant</option>
                </select>
            </div>
        </div>
    </div>
    @else
    <input type="hidden" name="type" id="type">
    @endif
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="username">ID Number</label>
                <input type="text" name="username" id="username" placeholder="ID Number" class="form-control {{!empty($user->type) && $user->type == 'admin' ? '' : 'readonly-input'}}" {{!empty($user->type) && $user->type == 'admin' ? '' : 'disabled'}}>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Change Password..." class="form-control change-password">
            </div>
            <div class="col-md-4">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" placeholder="Confirm Password" class="form-control change-password">
            </div>
        </div>
    </div>
</div>
<h5 class="mt-5">User Information</h5>
<div class="container-fluid">
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="middle_name">Middle Name</label>
                <input type="text" name="middle_name" id="middle_name" placeholder="Middle Name" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="form-group student-info-container" style="{{ !empty($data->type) && $data->type == 'student' ? '' : 'display: none;' }}">
        <div class="row">
            <div class="col-md-4">
                <label for="course">Course</label>
                <input type="text" name="course" id="course" placeholder="Course" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="year_id">Year Level</label>
                <select id="year_id" name="year_id" class="form-control" required>
                    @foreach ($year_levels as $key => $year_level)
                        <option value="{{ $year_level->id }}">{{ $year_level->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<hr/>
<div class="form-group">
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('UsersManagement') }}" class="btn btn-secondary">Back</a>
            <button class="btn btn-info" type="submit">Save</button>
        </div>
    </div>
</div>