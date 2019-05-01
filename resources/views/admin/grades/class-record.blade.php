@extends($print ? 'layouts.print' : 'layouts.app')

@section('content')
<div class="grades-management">
    <div class="filter-container mb-3 hide-on-print">
        <form action="{{ route('ViewClassRecords') }}" method="get">
            @if (!empty($classes) && $classes->count())
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="class">Please select class.</label>
                        <select name="class_id" class="form-control select2 submit-on-change">
                            <option value="">Select a Class</option>
                            @foreach ($classes as $key => $class)
                                <option value="{{ $class->id }}" {{ $class->id == $data->id ? 'selected' : '' }}>{{ $class->code . ' - ' . $class->year_level->name . ' - ' . $class->semester->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if (in_array($user->type, ['admin', 'teacher', 'assistant']) && !empty($data->id))
                    <div class="col-md-6">
                        <label for="class">Please select subject.</label>
                        <select name="classes_subject_id" class="form-control select2 submit-on-change">
                            <option value="">Select a Subject</option>
                            @foreach ($data->subjects as $key => $classes_subject)
                                <option value="{{ $classes_subject->id }}" {{ $classes_subject->id == @$subject->id ? 'selected' : '' }}>{{ $classes_subject->subject->code . ' - ' . $classes_subject->subject->description }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>
            </div>
            @else
            <h5><i class="fas fa-info-circle fa-sm"></i> No Assigned Class</h5>
            @endif
        </form>
    </div>

    @if($print)
    <div class="print-header">
        <div class="logo-container">
            <img class="brand-logo" src="{{ asset('img/dclogo.png') }}" alt="Diliman College Logo">
        </div>
        <div class="logo-side-text">
            <div class="title">DILIMAN COLLEGE</div> 
            <div class="sub">FINAL RATING SHEET</div>
        </div>
        <div class="logo-under-text">
            {{ $data->semester->name }}
        </div>
    </div>
    
        @if (in_array($user->type, ['admin', 'teacher']))
        <div calss="print-details">        
            <table class="table table-dark table-sm">
                <tbody>
                    <tr>
                        <td>SUBJECT CODE: {{ $subject->subject->code  }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>SUBJECT NAME: {{ $subject->subject->name  }}</td>
                        <td>SEMESTER: {{ $data->semester->name  }}</td>
                    </tr>
                    <tr>
                        <td>SUBJECT DESCRIPTION: {{ $subject->subject->description  }}</td>
                        <td>UNITS: {{ $subject->subject->units  }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endif
    @endif
    
    @if (in_array($user->type, ['admin', 'teacher', 'assistant']))
    <h5 class="hide-on-print"><i class="fas fa-list fa-sm"></i> Student list</h5>
    <div class="row hide-on-print">
        <div class="col-md-2">
            <a href="{{ strpos(Request::fullUrl(), '?') ? Request::fullUrl() . '&print=1' : '?print=1' }}" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-print fa-sm"></i> Print view</i></a>
        </div>
    </div>
    <div class="table-container-listing" style="{{ !$print ? 'overflow-x: scroll;' : '' }}">
        @if (!empty($subject))                                
        <table class="table table-bordered table-sm" style="{{ !$print ? '' : 'font-size: 7px;' }}">
            <thead>
                <tr>
                    <th scope="col">Student No.</th>
                    <th scope="col" style="{{ !$print ? 'min-width: 150px;' : '' }}">Last Name</th>
                    <th scope="col" style="{{ !$print ? 'min-width: 150px;' : '' }}">First Name</th>
                    <th scope="col" style="{{ !$print ? 'min-width: 110px;' : '' }}">Middle Name</th>
                    @if (!empty($classes_subject->computations->where('period', 'prelim')))
                        @foreach ($classes_subject->computations->where('period', 'prelim') as $key => $computation)
                            <th scope="col">{{ $computation->name . ' (' . $computation->value .'%)' }}</th>
                        @endforeach
                        <th scope="col" class="text-center text-info" style="{{ !$print ? 'min-width: 110px;' : '' }}">Prelim Grade</th>
                    @endif
                    @if (!empty($classes_subject->computations->where('period', 'midterm')))
                        @foreach ($classes_subject->computations->where('period', 'midterm') as $key => $computation)
                            <th scope="col">{{ $computation->name . ' (' . $computation->value .'%)' }}</th>
                        @endforeach
                        <th scope="col" class="text-center text-info" style="{{ !$print ? 'min-width: 125px;' : '' }}">Midterm Grade</th>
                    @endif
                    @if (!empty($classes_subject->computations->where('period', 'final')))
                        @foreach ($classes_subject->computations->where('period', 'final') as $key => $computation)
                            <th scope="col">{{ $computation->name . ' (' . $computation->value .'%)' }}</th>
                        @endforeach
                        <th scope="col" class="text-center text-info" style="{{ !$print ? 'min-width: 110px;' : '' }}">Finals Grade</th>
                    @endif
                    <th scope="col" class="text-center text-info">FCG</th>
                    <th scope="col" class="text-center text-info">GPE</th>
                    <th scope="col" class="text-center text-info">Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->students as $key => $st)
                    <tr>
                        <th scope="row">
                            {{ $st->student->username }}
                        </th>
                        <td>
                            {{ $st->student->first_name }}
                        </td>
                        <td>
                            {{ $st->student->last_name }}
                        </td>
                        <td>
                            {{ $st->student->middle_name }}
                        </td>
                        <?php
                            $student_status = $subject->grades->where('student_id', $st->student->id)->where('period', null)->first();
                            $prelim_grade = $subject->grades->where('student_id', $st->student->id)->where('period', 'prelim')->first();
                            $prelim_remarks = $prelim_grade['remarks'];
                            $prelim_grade = $prelim_grade['computed_grade'];
                            $midterm_grade = $subject->grades->where('student_id', $st->student->id)->where('period', 'midterm')->first();
                            $midterm_remarks = $midterm_grade['remarks'];
                            $midterm_grade = $midterm_grade['computed_grade'];
                            $final_grade = $subject->grades->where('student_id', $st->student->id)->where('period', 'final')->first();
                            $final_remarks = $final_grade['remarks'];
                            $final_grade = $final_grade['computed_grade'];
                            if (!empty($prelim_grade) && !empty($midterm_grade) && !empty($final_grade)) {
                                $final = doubleval(($prelim_grade ? $prelim_grade : 0)) * doubleval('0.'.$subject->prelim) + doubleval(($midterm_grade ? $midterm_grade : 0)) * doubleval('0.'.$subject->midterm) + doubleval(($final_grade ? $final_grade : 0)) * doubleval('0.'.$subject->final);
                                $final = round($final, 2);
                                $remarks = 'PASSED';
                                if ($final >= doubleval(74.50) && $final <= doubleval(75.49)) {
                                    $scale = doubleval(3.00);
                                } else if ($final >= doubleval(75.50) && $final <= doubleval(78.49)) {
                                    $scale = doubleval(2.75);
                                } else if ($final >= doubleval(78.50) && $final <= doubleval(81.49)) {
                                    $scale = doubleval(2.50);
                                } else if ($final >= doubleval(81.50) && $final <= doubleval(84.49)) {
                                    $scale = doubleval(2.25);
                                } else if ($final >= doubleval(84.50) && $final <= doubleval(87.49)) {
                                    $scale = doubleval(2.00);
                                } else if ($final >= doubleval(87.50) && $final <= doubleval(90.49)) {
                                    $scale = doubleval(1.75);
                                } else if ($final >= doubleval(90.50) && $final <= doubleval(93.49)) {
                                    $scale = doubleval(1.50);
                                } else if ($final >= doubleval(93.50) && $final <= doubleval(96.49)) {
                                    $scale = doubleval(1.25);
                                } else if ($final >= doubleval(96.50) && $final <= doubleval(100.00)) {
                                    $scale = doubleval(1.00);
                                } else {
                                    $scale = doubleval(5.00);
                                    $remarks = 'FAILED';
                                }
                            } else {
                                $final = 'INC';
                                $scale = doubleval(5.00);
                                $remarks = 'FAILED';
                            }
                            if (@$student_status->remarks == 'drop') {
                                $remarks = strtoupper('DRP');
                            } else if (!empty($prelim_remarks) && $remarks == 'FAILED') {
                                $remarks = strtoupper($prelim_remarks== 'incomplete' ? 'INC' : $prelim_remarks);
                            } else if (!empty($midterm_remarks) && $remarks == 'FAILED') {
                                $remarks = strtoupper($midterm_remarks== 'incomplete' ? 'INC' : $midterm_remarks);
                            } else if (!empty($final_remarks) && $remarks == 'FAILED') {
                                $remarks = strtoupper($final_remarks== 'incomplete' ? 'INC' : $final_remarks);
                            }
                        ?>
                        <?php $grade = $subject->grades->where('student_id', $st->student->id)->where('period', 'prelim')->first(); ?>
                        @if (!empty($classes_subject->computations->where('period', 'prelim')))
                            @foreach ($classes_subject->computations->where('period', 'prelim') as $computation_key => $computation)
                                <?php unset($grades_item); if (!empty($grade)) {$grades_item = $grade->items->where('computation_id', $computation->id)->first();} ?>
                                <td>
                                    {{ @$grades_item->value }}
                                </td>
                            @endforeach
                            <td class="text-center text-info">
                                {{ $remarks == 'DROPPED' ? '-' : $prelim_grade }}
                            </td>
                        @endif
                        <?php $grade = $subject->grades->where('student_id', $st->student->id)->where('period', 'midterm')->first(); ?>
                        @if (!empty($classes_subject->computations->where('period', 'midterm')))
                            @foreach ($classes_subject->computations->where('period', 'midterm') as $computation_key => $computation)
                                <?php unset($grades_item); if (!empty($grade)) {$grades_item = $grade->items->where('computation_id', $computation->id)->first();} ?>
                                <td>
                                    {{ @$grades_item->value }}
                                </td>
                            @endforeach
                            <td class="text-center text-info">
                                {{ $remarks == 'DROPPED' ? '-' : $midterm_grade }}
                            </td>
                        @endif
                        <?php $grade = $subject->grades->where('student_id', $st->student->id)->where('period', 'final')->first(); ?>
                        @if (!empty($classes_subject->computations->where('period', 'final')))
                            @foreach ($classes_subject->computations->where('period', 'final') as $computation_key => $computation)
                                <?php unset($grades_item); if (!empty($grade)) {$grades_item = $grade->items->where('computation_id', $computation->id)->first();} ?>
                                <td>
                                    {{ @$grades_item->value }}
                                </td>
                            @endforeach
                            <td class="text-center text-info">
                                {{ $remarks == 'DROPPED' ? '-' : $final_grade }}
                            </td>
                        @endif
                        <td class="text-center text-info">
                            {{ $remarks == 'DROPPED' ? '-' : $final }}
                        </td>
                        <td class="text-center text-info">
                            {{ $remarks == 'DROPPED' ? '-' : $scale }}
                        </td>
                        <td class="text-center text-info">
                            {{ strtoupper(@$remarks) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @elseif ($data->students->count() == 0) 
            <h5><i class="fas fa-info-circle fa-sm"></i> No students assigned.</h5>
        @else
            <h5><i class="fas fa-info-circle fa-sm"></i> Select Subject first.</h5>
        @endif
    </div>
    @endif

</div>
@stop
@include('admin.helper.form-helper')
@section('added-scripts')
<script>
    $(document).ready(function() {
        $('.submit-on-change').on('change', function () {
            if ($(this).attr('name') == 'class_id') {
                $('select[name="classes_subject_id"]').prop('disabled', true);
            }
            $(this).closest('form').submit();
        });
    });
</script>
@stop