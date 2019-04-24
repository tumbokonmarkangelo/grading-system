@extends($print ? 'layouts.print' : 'layouts.app')

@section('content')
<div class="grades-management">
    @if($user->type == 'admin')
    <div class="filter-container mb-3">
        <form action="{{ route('ViewGradeRecords') }}" method="get">
            @if (!empty($students) && $students->count())
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="class">Please student class.</label>
                        <select name="username" class="form-control select2 submit-on-change">
                            <option value="">Select a student</option>
                            @foreach ($students as $key => $st)
                                <option value="{{ $st->username }}" {{ $st->username == @$username ? 'selected' : '' }}>{{ $st->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            @else
            <h5><i class="fas fa-info-circle fa-sm"></i> No Assigned Class</h5>
            @endif
        </form>
    </div>
    @endif

    @if($print)
    <div class="print-header">
        <div class="logo-container">
            <img class="brand-logo" src="{{ asset('img/dclogo.png') }}" alt="Diliman College Logo">
        </div>
        <div class="logo-side-text">
            <div class="title">DILIMAN COLLEGE</div> 
            <div class="sub">STUDENT RECORD</div>
        </div>
    </div>

    <div calss="print-details">        
        <table class="table table-dark table-sm">
            <tbody>
                <tr>
                    <td>NAME: {{ $student->name  }}</td>
                    <td>STUDENT NO.: {{ $student->username  }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @endif
    
    @if (!empty($student->grades) && $student->grades->count())
    <h5 class="hide-on-print"><i class="fas fa-list fa-sm"></i> Student Record</h5>
    <div class="row hide-on-print">
        <div class="col-md-2">
            <a href="?print=1" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-print fa-sm"></i> Print view</i></a>
        </div>
    </div>
    @foreach ($year_levels as $yl_key => $yl)
        @if($subjects->where('class.year_id', $yl->id)->count())
        <div class="table-container-listing">
        <h5 class="mb-0 text-center text-info">{{ $yl->name }}</h5>
        <table class="table table-bordered table-sm">
            @foreach ($semesters as $sem_key => $sem)
                <?php $selected_subjects = $subjects->where('class.year_id', $yl->id)->where('class.semester_id', $sem->id); ?>
                @if($selected_subjects->count() > 0)
                <thead>
                    <tr>
                        <th scope="col" colspan="6" class="text-info">{{ $sem->name }}</th>
                    </tr>
                    <tr>
                        <th scope="col">Subject code</th>
                        <th scope="col">Subject name</th>
                        <th scope="col" class="text-center">Units</th>
                        <th scope="col" class="text-center">Final Grade</th>
                        <th scope="col" class="text-center">Scale</th>
                        <th scope="col" class="text-center">Reamarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $units_counter = 0; ?>
                    <?php $points_counter = 0; ?>
                    @foreach ($selected_subjects as $key => $subject)
                    <tr>
                        <th scope="row">
                            {{ $subject->subject->code }}
                        </th>
                        <td>
                            {{ $subject->subject->name }}
                        </td>
                        <td class="text-center">
                            {{ $subject->subject->units }}
                        </td>
                        <?php
                            $student_status = $subject->grades->where('student_id', $student->id)->where('period', null)->first();
                            if (@$student_status->remarks !== 'drop') $units_counter += $subject->subject->units;
                            $prelim_grade = $subject->grades->where('student_id', $student->id)->where('period', 'prelim')->first();
                            $prelim_remarks = $prelim_grade['remarks'];
                            $prelim_grade = $prelim_grade['computed_grade'];
                            $midterm_grade = $subject->grades->where('student_id', $student->id)->where('period', 'midterm')->first();
                            $midterm_remarks = $midterm_grade['remarks'];
                            $midterm_grade = $midterm_grade['computed_grade'];
                            $final_grade = $subject->grades->where('student_id', $student->id)->where('period', 'final')->first();
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
                                if (@$student_status->remarks !== 'drop') $points_counter += round(($final * $subject->subject->units),2);
                            } else {
                                $final = 'Incomplete';
                                $scale = doubleval(5.00);
                                $remarks = 'FAILED';
                            }
                            if (@$student_status->remarks == 'drop') {
                                $remarks = strtoupper('dropped');
                            } else if (!empty($prelim_remarks) && $remarks == 'FAILED') {
                                $remarks = strtoupper($prelim_remarks);
                            } else if (!empty($midterm_remarks) && $remarks == 'FAILED') {
                                $remarks = strtoupper($midterm_remarks);
                            } else if (!empty($final_remarks) && $remarks == 'FAILED') {
                                $remarks = strtoupper($final_remarks);
                            }
                        ?>
                        <td class="text-center">
                            {{ $remarks == 'DROPPED' ? '-' : $final }}
                        </td>
                        <td class="text-center">
                            {{ $remarks == 'DROPPED' ? '-' : $scale }}
                        </td>
                        <td class="text-center">
                            {{ ucfirst(@$remarks) }}
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" class="text-right text-success">
                            Total Units
                        </td>
                        <td  class="text-center text-success">
                            {{ $units_counter }}
                        </td>
                        <td colspan="3" >
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-right text-success">
                            GWA
                        </td>
                        <td  class="text-center text-success">
                            {{ round($points_counter / $units_counter, 2) }}
                        </td>
                        <td colspan="3" >
                        </td>
                    </tr>
                </tbody>
                @endif
            @endforeach
        </table>
        </div>
        @endif
    @endforeach
    @elseif (!empty($student->grades) && $student->grades->count() == 0) 
        <h5><i class="fas fa-info-circle fa-sm"></i> No records yet.</h5>
    @else
        <h5><i class="fas fa-info-circle fa-sm"></i> Select student first.</h5>
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