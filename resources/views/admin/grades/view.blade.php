@extends($print ? 'layouts.print' : 'layouts.app')

@section('content')
<div class="grades-management">
    <div class="filter-container mb-3 hide-on-print">
        <form action="{{ route('ViewGrade') }}" method="get">
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
                    @if (in_array($user->type, ['admin', 'teacher']) && !empty($data->id))
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
    
        @if ($user->type == 'student' && !empty($data) && $data->count())
        <div calss="print-details">        
            <table class="table table-dark table-sm">
                <tbody>
                    <tr>
                        <td>STUDENT NO.: {{ $user->username  }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>NAME: {{ $user->name  }}</td>
                        <td>YEAR LEVEL: {{ @$data->year_level->name  }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @elseif (in_array($user->type, ['admin', 'teacher']))
        <div calss="print-details">        
            <table class="table table-dark table-sm">
                <tbody>
                    <tr>
                        <td>SUBJECT CODE: {{ $subject->subject->code  }}</td>
                        <td>SUBJECT DESCRIPTION: {{ $subject->subject->description  }}</td>
                    </tr>
                    <tr>
                        <td>COURSE/YR: {{ $data->year_level->name  }}</td>
                        <td>UNITS: {{ $subject->subject->units  }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endif
    @endif

    @if ($user->type == 'student' && !empty($data) && $data->count())
    <h5 class="hide-on-print"><i class="fas fa-list fa-sm"></i> Subject list</h5>
    <div class="row hide-on-print">
        <div class="col-md-2">
            <a href="?print=1" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-print fa-sm"></i> Print view</i></a>
        </div>
    </div>
    <div class="table-container-listing">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th scope="col">Subject code</th>
                    <th scope="col">Description</th>
                    <th scope="col" class="text-center">Units</th>
                    <th scope="col" class="text-center">Final</th>
                    <th scope="col" class="text-center">Scale</th>
                    <th scope="col" class="text-center">Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php $units_counter = 0; ?>
                <?php $points_counter = 0; ?>
                @foreach ($data->subjects as $key => $subject)
                    <tr>
                        <th scope="row">
                            {{ $subject->subject->code }}
                        </th>
                        <td>
                            {{ $subject->subject->grades }}
                        </td>
                        <td class="text-center">
                            {{ $subject->subject->units }}
                        </td>
                        <?php
                            $student_status = $subject->grades->where('student_id', $user->id)->where('period', null)->first();
                            if (@$student_status->remarks !== 'drop') $units_counter += $subject->subject->units;
                            $prelim_grade = $subject->grades->where('student_id', $user->id)->where('period', 'prelim')->first();
                            $prelim_remarks = $prelim_grade['remarks'];
                            $prelim_grade = $prelim_grade['computed_grade'];
                            $midterm_grade = $subject->grades->where('student_id', $user->id)->where('period', 'midterm')->first();
                            $midterm_remarks = $midterm_grade['remarks'];
                            $midterm_grade = $midterm_grade['computed_grade'];
                            $final_grade = $subject->grades->where('student_id', $user->id)->where('period', 'final')->first();
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
                            if (@$student_status->remarks !== 'drop') {
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
        </table>
        @if ($data->subjects->count() == 0) 
            <h5><i class="fas fa-info-circle fa-sm"></i> No grades yet.</h5>
        @endif
    </div>
    @elseif (in_array($user->type, ['admin', 'teacher']))
    <h5 class="hide-on-print"><i class="fas fa-list fa-sm"></i> Student list</h5>
    <div class="row hide-on-print">
        <div class="col-md-2">
            <a href="?print=1" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-print fa-sm"></i> Print view</i></a>
        </div>
    </div>
    <div class="table-container-listing">
        @if (!empty($subject))                                
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th scope="col">Student number</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Middle Name</th>
                    <th scope="col" class="text-center">Final Grade</th>
                    <th scope="col" class="text-center">Scale</th>
                    <th scope="col" class="text-center">Remarks</th>
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
                            $student_status = $subject->grades->where('student_id', $user->id)->where('period', null)->first();
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
                                $final = 'Incomplete';
                                $scale = doubleval(5.00);
                                $remarks = 'FAILED';
                            }
                            if (@$student_status->remarks !== 'drop') {
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

    @if($print)
    <div class="print-footer">
        <div class="left-container">
            <div class="header">
                FINAL RATING GUIDELINES:
            </div>
<pre>
1. Rating sheets should be computerized and in triplicate copy
per subject. 		
(original copy for the Registrar, duplicate for the Dean, triplicate
for the Professor/ Instructor)		
2. Do not forget to put a remark opposite to the grade of the student.
(Grade of: 1.00 to 3.00 - Passed / 5.00 - Failed / INC - NFE/NFR /W
- Withdrawn / D - Dropped)		
3. Separate the list of Regula students from the irregular students
per course.		
4. After all the names of your students have been listed, close the
entry by encoding the asterisks and nothing follows.
</pre>
        </div>
        <div class="right-container">
            <div class="header">
                CERTIFIED CORRECT:
            </div>
            <div class="signature-container">
                <div class="name"></div>
                <div class="line"></div>
                <div class="title">Dr. Carolina R. Duka</div>
            </div>
            <div class="signature-container">
                <div class="name">Ma'am Emelita D. Bernabe</div>
                <div class="line"></div>
                <div class="title">Dean</div>
            </div>
            <div class="signature-container">
                <div class="name">Ms. Girlie Bernardino</div>
                <div class="line"></div>
                <div class="title">Registrar</div>
            </div>
        </div>
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