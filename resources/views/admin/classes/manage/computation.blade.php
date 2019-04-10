@extends('layouts.app')

@section('content')
<div class="classes-management">
    <div class="button-container mb-4">
        <a href="{{ route('ManageClassSubject', [$data->class_id]) }}" class="btn btn-success btn-sm"><i class="fas fa-reply"></i> Back to Edit Class Subjects</a>
    </div>
    <div class="button-container mb-4">
        <a href="{{ route('ManageClassSubjectComputaion', [$data->id, 'period' => 'prelim']) }}" class="btn {{ !empty($period) && $period == 'prelim' ? 'btn-secondary' : 'btn-info' }} btn-sm">Prelim Period</a>
        <a href="{{ route('ManageClassSubjectComputaion', [$data->id, 'period' => 'midterm']) }}" class="btn {{ !empty($period) && $period == 'midterm' ? 'btn-secondary' : 'btn-info' }} btn-sm">Midterm Period</a>
        <a href="{{ route('ManageClassSubjectComputaion', [$data->id, 'period' => 'final']) }}" class="btn {{ !empty($period) && $period == 'final' ? 'btn-secondary' : 'btn-info' }} btn-sm">Final Period</a>
    </div>
    <form id="createClass" class="ajax-submit form-computation" action="{{ route('UpdateClassSubjectComputaion', [$data->id, 'period' => !empty($period) ? $period : 'prelim']) }}" method="patch" autocomplete="off">
        @include('admin.classes.manage.computation-form')
    </form>
</div>
@include('admin.helper.form-helper')
@stop