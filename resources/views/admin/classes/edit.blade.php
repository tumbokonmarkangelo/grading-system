@extends('layouts.app')

@section('content')
<div class="classes-management">
    <div class="button-container mb-4">
        <a href="{{ route('ManageClassSubject', [$data->id]) }}" class="btn btn-success btn-sm"><i class="fas fa-chalkboard-teacher fa-sm"></i> View/Edit Subjects</a>
        <a href="{{ route('ManageClassStudent', [$data->id]) }}" class="btn btn-success btn-sm"><i class="fas fa-user-graduate fa-sm"></i> View/Edit Student</a>
    </div>
    <form id="createClass" class="ajax-submit need-help" action="{{ route('UpdateClass', [$data->id]) }}" method="patch" autocomplete="off">
        @include('admin.classes.form')
    </form>
</div>
@include('admin.helper.form-helper')
@stop