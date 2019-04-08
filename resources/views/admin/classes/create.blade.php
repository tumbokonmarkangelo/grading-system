@extends('layouts.app')

@section('content')
<div class="classes-management">
    <form id="createClasses" class="ajax-submit need-help" action="{{ route('StoreClass') }}" method="post" autocomplete="off">
        @include('admin.classes.form')
    </form>
</div>
@include('admin.helper.form-helper')
@stop