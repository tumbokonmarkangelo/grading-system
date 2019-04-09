<h5>Login Credentials</h5>
<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            <select name="type" class="form-control">
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
            <input type="text" name="username" placeholder="Username" class="form-control" disabled>
        </div>
        <div class="col-md-4">
            <input type="email" name="email" placeholder="Email" class="form-control">
        </div>
        <div class="col-md-4">
            <input type="password" name="password" placeholder="Password" class="form-control">
        </div>
    </div>
</div>
<h5>User Information</h5>
<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="first_name" placeholder="First Name" class="form-control" required>
        </div>
        <div class="col-md-4">
            <input type="text" name="middle_name" placeholder="Middle Name" class="form-control">
        </div>
        <div class="col-md-4">
            <input type="text" name="last_name" placeholder="Last Name" class="form-control" required>
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