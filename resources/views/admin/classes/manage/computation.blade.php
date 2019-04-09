@extends('layouts.app')

@section('content')
<div class="classes-management">
    <div class="button-container mb-4">
        <a href="{{ route('ManageClassSubject', [$data->id]) }}" class="btn btn-success btn-sm"><i class="fas fa-reply"></i> Back to Edit Class</a>
    </div>
    <form id="createClass" class="ajax-submit form-computation" action="{{ route('UpdateClassSubjectComputaion', [$data->id]) }}" method="patch" autocomplete="off">
        @include('admin.classes.manage.computation-form')
    </form>
</div>
@include('admin.helper.form-helper')
@stop