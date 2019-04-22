<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createUser" class="ajax-submit" action="{{ route('CreateUser') }}" method="post" autocomplete="off">
                        <h5>User Information</h5>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="email" name="email" placeholder="Email" class="form-control">
                                </div>
                            </div>
                        </div>
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
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <hr/>
                            </div>
                        </div>
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
                                    <input type="text" name="username" placeholder="Username" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="password" name="password" placeholder="Password" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-info" type="submit" form="createUser">Save</button>
            </div>
        </div>
    </div>
</div>