<h5>Login Credentials</h5>
<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            <label for="type">User Type</label>
            <select name="type" id="type" class="form-control">
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                <option value="admin">Admin</option>
            </select>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Username" class="form-control" disabled>
        </div>
        <div class="col-md-4">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Change Password..." class="form-control change-password">
        </div>
    </div>
</div>
<h5>User Information</h5>
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
<hr/>
<div class="form-group">
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('UsersManagement') }}" class="btn btn-secondary">Back</a>
            <button class="btn btn-info" type="submit">Save</button>
        </div>
    </div>
</div>