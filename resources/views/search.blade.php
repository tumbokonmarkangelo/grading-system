@extends('layouts.app')

@section('content')
    <div class="search-result">
        <div class="container-fluid">
            <div class="col-md-8">
                @if (!empty($students) && $students->count() > 0)
                    @foreach ($students as $key => $data)
                    <div class="result-container">
                        <div class="parent-container">
                            {{ $data->username . ' ' . $data->name }}
                            @if (!empty($data->student_info))
                            <div class="parent-sub-container">
                                {{ @$data->student_info->course . ' - ' . @$data->student_info->year_level->name }}
                            </div>
                            @endif
                        </div>
                        <div class="shortcuts-container pl-4 pr-4">
                            <div class="shortcuts-sub-container">
                                <i class="fas fa-link fa-sm"></i> Links
                            </div>
                            <ul>
                                <li><a href="{{ route('ViewGradeRecords', $data->username) }}">View all recorded grades</a></li>
                            </ul>
                            @if (!empty($data->classes) && $data->classes->count() > 0)
                            <div class="shortcuts-sub-container">
                                <i class="fas fa-link fa-sm"></i> Classes
                            </div>
                            <ul>
                            @foreach ($data->classes as $key => $class)
                                <li><a href="{{ route('ViewClassRecords', ['class_id'=>$class->class->id]) }}">View class recorded of {{ $class->class->code }}</a></li>
                                <li><a href="{{ route('ViewGrade', ['class_id'=>$class->class->id]) }}">View grades of class {{ $class->class->code }}</a></li>
                            @endforeach
                            </ul>
                            @else
                            <div class="shortcuts-sub-container">
                                <i class="fas fa-info-circle fa-sm"></i> No Classes Found.
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @endif
                @if (!empty($teachers) && $teachers->count() > 0)
                    @foreach ($teachers as $key => $data)
                    <div class="result-container">
                        <div class="parent-container">
                            {{ $data->username . ' ' . $data->name }}
                        </div>
                        <div class="shortcuts-container pl-4 pr-4">
                            @if (!empty($data->classes) && $data->classes->count() > 0)
                            <div class="shortcuts-sub-container">
                                <i class="fas fa-link fa-sm"></i> Classes Links
                            </div>
                            <ul>
                            @foreach ($data->classes as $key => $class)
                                <li><a href="{{ route('ManageClassSubject', ['class_id'=>$class->class->id]) }}">Manage class subjects ({{ $class->class->code }})</a></li>
                                <li><a href="{{ route('ViewClassRecords', ['class_id'=>$class->class->id, 'classes_subject_id'=>$class->id]) }}">View class recorded of {{ $class->class->code . ' - ' . $class->subject->name }}</a></li>
                                <li><a href="{{ route('ViewGrade', ['class_id'=>$class->class->id, 'classes_subject_id'=>$class->id]) }}">View grades of class {{ $class->class->code . ' - ' . $class->subject->name }}</a></li>
                            @endforeach
                            </ul>
                            @else
                            <div class="shortcuts-sub-container">
                                <i class="fas fa-info-circle fa-sm"></i> No Classes Found.
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @endif
                @if (!empty($subjects) && $subjects->count() > 0)
                    @foreach ($subjects as $key => $data)
                    <div class="result-container">
                        <div class="parent-container">
                            {{ $data->code . ' ' . $data->name }}
                            <div class="parent-sub-container">
                                {{ @$data->description }}
                            </div>
                        </div>
                        <div class="shortcuts-container pl-4 pr-4">
                            @if (!empty($data->classes) && $data->classes->count() > 0)
                            <div class="shortcuts-sub-container">
                                <i class="fas fa-link fa-sm"></i> Classes Links
                            </div>
                            <ul>
                            @foreach ($data->classes as $key => $class)
                                <li><a href="{{ route('EditClass', ['class_id'=>$class->class->id]) }}">Edit class ({{ $class->class->code }})</a></li>
                                <li><a href="{{ route('ManageClassSubject', ['class_id'=>$class->class->id]) }}">Manage class subjects ({{ $class->class->code }})</a></li>
                                <li><a href="{{ route('ManageClassStudent', ['class_id'=>$class->class->id]) }}">Manage class students ({{ $class->class->code }})</a></li>
                            @endforeach
                            </ul>
                            @else
                            <div class="shortcuts-sub-container">
                                <i class="fas fa-info-circle fa-sm"></i> No Classes Found.
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@stop