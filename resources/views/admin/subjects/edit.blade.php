@extends('layouts.app')

@section('content')
<div class="subject-management">
    <form id="createSubject" class="ajax-submit need-help" action="{{ route('UpdateSubject', [$data->id]) }}" method="patch" autocomplete="off">
        @include('admin.subjects.form')
    </form>
</div>
@include('admin.helper.form-helper')
@stop