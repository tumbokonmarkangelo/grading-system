@extends('layouts.app')

@section('content')
<div class="classes-management">
    <div class="add-classes">
        <a href="{{ route('CreateClass') }}" class="btn btn-success"><i class="fas fa-plus-circle fa-sm"></i> Create New Class</a>
    </div>
    
    @if ($data->count())
    <div class="table-container-listing">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Code</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $d)
                    <tr>
                        <th scope="row">
                            {{ $d->id }}
                        </th>
                        <td>
                            {{ $d->code }}
                        </td>
                        <td class="text-center">
                            <form confirmation="true" class="ajax-submit" action="{{ route('DeleteClass') }}" method="post">
                                <input type="hidden" value="{{ $d->id }}" name="id">
                                <button class="btn btn-info btn-sm" type="submit">Delete</button>
                                <a href="{{ route('EditClass', [$d->id]) }}" class="btn btn-success btn-sm" type="Edit">Edit</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@stop