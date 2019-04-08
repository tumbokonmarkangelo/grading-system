@extends('layouts.app')

@section('content')
<div class="subject-management">
    <form id="createSubject" class="ajax-submit need-help" action="{{ route('StoreSubject') }}" method="post" autocomplete="off">
        @include('admin.subjects.form')
    </form>
</div>
@include('admin.helper.form-helper')
@stop