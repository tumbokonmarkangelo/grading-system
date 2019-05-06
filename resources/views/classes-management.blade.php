@extends('layouts.app')

@section('content')
<div class="classes-management">
    @if (!empty($user = Auth::user()) && $user->type == 'admin')
    <div class="add-classes">
        <a href="{{ route('CreateClass') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle fa-sm"></i> Create New Class</a>
    </div>
    @endif
    
    @if ($data->count())
    <div class="table-filter-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 offset-md-8">
                    <form action="{{ route('ClassesManagement') }}" method="get" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" name="keyword" value="{{ @$keyword }}" class="form-control border-0 small" placeholder="Search class by code" aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="table-container-listing">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Code</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Year Level</th>
                    <th scope="col">Status</th>
                    @if (!empty($user = Auth::user()) && $user->type == 'admin')
                    <th scope="col" class="text-center">Action</th>
                    @endif
                    <th scope="col" class="text-center">Shortcuts <i class="fas fa-link fa-sm"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $d)
                    <tr>
                        <th scope="row">
                            {{ $d->id }}
                        </th>
                        <td>
                            {{ $d->code }}
                        </td>
                        <td>
                            {{ @$d->semester->name }}
                        </td>
                        <td>
                            {{ @$d->year_level->name }}
                        </td>
                        <td>
                            {{ @$d->status }}
                        </td>
                        @if (!empty($user = Auth::user()) && $user->type == 'admin')
                        <td class="text-center">
                            <form confirmation="true" class="ajax-submit" action="{{ route('DeleteClass') }}" method="post">
                                <input type="hidden" value="{{ $d->id }}" name="id">
                                <a href="{{ route('EditClass', [$d->id]) }}" class="btn btn-success btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </td>
                        @endif
                        <td class="text-center">
                            <a href="{{ route('ManageClassSubject', [$d->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-chalkboard-teacher fa-sm"></i> Subjects</a>
                            @if (!empty($user = Auth::user()) && in_array($user->type, ['admin']))
                            <a href="{{ route('ManageClassStudent', [$d->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-user-graduate fa-sm"></i> Student</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <h5 class="mt-3"><i class="fas fa-info-circle fa-sm"></i> No Classes yet.</h5>
    @endif
</div>
@stop