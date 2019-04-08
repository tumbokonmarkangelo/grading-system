@extends('layouts.app')

@section('content')
<div class="user-management">
    <form id="editUser" class="ajax-submit need-help" action="{{ route('UpdateUser', [$data->id]) }}" method="patch" autocomplete="off">
        @include('admin.users.form')
    </form>
</div>
@include('admin.helper.form-helper')
@stop