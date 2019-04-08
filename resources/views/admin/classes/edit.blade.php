@extends('layouts.app')

@section('content')
<div class="classes-management">
    <form id="createClass" class="ajax-submit need-help" action="{{ route('UpdateClass', [$data->id]) }}" method="patch" autocomplete="off">
        @include('admin.Classes.form')
    </form>
</div>
@include('admin.helper.form-helper')
@stop