@extends('layouts.app')

@section('content')
<div class="classes-management">
    <div class="button-container mb-4">
        <a href="{{ route('EditClass', [$data->id]) }}" class="btn btn-success btn-sm"><i class="fas fa-reply"></i> Back to Edit Class</a>
    </div>
    <form id="createClass" class="ajax-submit" action="{{ route('UpdateClassStudent', [$data->id]) }}" method="patch" autocomplete="off">
        @include('admin.classes.manage.students-form')
    </form>
</div>
@include('admin.helper.form-helper')
@stop