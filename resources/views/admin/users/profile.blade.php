@extends('layouts.app')

@section('content')
<div class="user-profile">
    <div class="manage-profile">
        <a href="{{ route('ManageProfile') }}" class="btn btn-success btn-sm"><i class="fas fa-edit fa-sm"></i> Manage Profile</a>
        @include('admin.users.view')
    </div>
</div>
@stop