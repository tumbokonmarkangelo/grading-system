@extends('layouts.app')

@section('content')
<div class="user-management">
    <div class="add-user">
        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#createUserModal"><i class="fas fa-plus-circle fa-sm"></i> Create New User</button>
    </div>
    
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @if ($students->count())
        <li class="nav-item">
            <a class="nav-link active" id="students-tab" data-toggle="tab" href="#students" role="tab" aria-controls="students" aria-selected="true">Students</a>
        </li>
        @endif
        @if ($teachers->count())
        <li class="nav-item">
            <a class="nav-link" id="teachers-tab" data-toggle="tab" href="#teachers" role="tab" aria-controls="teachers" aria-selected="false">Teachers</a>
        </li>
        @endif
        @if ($admins->count())
        <li class="nav-item">
            <a class="nav-link" id="admins-tab" data-toggle="tab" href="#admins" role="tab" aria-controls="admins" aria-selected="false">Admins</a>
        </li>
        @endif
    </ul>
    <div class="tab-content" id="myTabContent">
        @if ($students->count())
        <div class="tab-pane fade show active" id="students" role="tabpanel" aria-labelledby="students-tab">
            <div class="user-table-container">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $key => $student)
                            <tr>
                                <th scope="row">
                                    {{ $student->id }}
                                </th>
                                <td>
                                    {{ $student->username }}
                                </td>
                                <td>
                                    {{ $student->first_name }}
                                </td>
                                <td>
                                    {{ $student->last_name }}
                                </td>
                                <td>
                                    {{ $student->email }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        @if ($teachers->count())
        <div class="tab-pane fade show" id="teachers" role="tabpanel" aria-labelledby="teachers-tab">
            <div class="user-table-container">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $key => $teacher)
                            <tr>
                                <th scope="row">
                                    {{ $teacher->id }}
                                </th>
                                <td>
                                    {{ $teacher->username }}
                                </td>
                                <td>
                                    {{ $teacher->first_name }}
                                </td>
                                <td>
                                    {{ $teacher->last_name }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        @if ($admins->count())
        <div class="tab-pane fade show" id="admins" role="tabpanel" aria-labelledby="admins-tab">
            <div class="user-table-container">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $key => $admin)
                            <tr>
                                <th scope="row">
                                    {{ $admin->id }}
                                </th>
                                <td>
                                    {{ $admin->username }}
                                </td>
                                <td>
                                    {{ $admin->first_name }}
                                </td>
                                <td>
                                    {{ $admin->last_name }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
@stop