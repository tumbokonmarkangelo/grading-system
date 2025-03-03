@extends('layouts.app')

@section('content')
<div class="subjects-management">
    <div class="add-subjects">
        <a href="{{ route('CreateSubject') }}" class="btn btn-success btn-sm"><i class="fas fa-plus-circle fa-sm"></i> Create New Subject</a>
    </div>
    
    <div class="table-filter-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 offset-md-8">
                    <form action="{{ route('SubjectsManagement') }}" method="get" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 float-right">
                        <div class="input-group">
                            <input type="text" name="keyword" value="{{ @$keyword }}" class="form-control border-0 small" placeholder="Filter subjects by keyword..." aria-label="Search" aria-describedby="basic-addon2">
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
    @if ($data->count())
    <div class="table-container-listing">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Code</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col" class="text-center">Units</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Year Level</th>
                    <th scope="col" class="text-center">Action</th>
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
                            {{ $d->name }}
                        </td>
                        <td>
                            {{ $d->description }}
                        </td>
                        <td class="text-center">
                            {{ $d->units }}
                        </td>
                        <td>
                            {{ @$d->semester->name }}
                        </td>
                        <td>
                            {{ @$d->year_level->name }}
                        </td>
                        <td class="text-center">
                            <form confirmation="true" class="ajax-submit" action="{{ route('DeleteSubject') }}" method="post">
                                <input type="hidden" value="{{ $d->id }}" name="id">
                                <a href="{{ route('EditSubject', [$d->id]) }}" class="btn btn-success btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <h5 class="mt-3"><i class="fas fa-info-circle fa-sm"></i> No Subjects yet.</h5>
    @endif
</div>
@stop