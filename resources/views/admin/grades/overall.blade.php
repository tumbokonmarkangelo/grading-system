@extends('layouts.app')

@section('content')
<div class="grades-management">
    <div class="filter-container mb-3">
        <form action="{{ route('ViewGradeRecords') }}" method="get">
            @if (!empty($data) && $data->count())
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="class">Please student class.</label>
                        <select name="username" class="form-control select2 submit-on-change">
                            <option value="">Select a student</option>
                            @foreach ($data as $key => $st)
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
    

    @if (!empty($student->grades) && $student->grades->count())
    <h5><i class="fas fa-list fa-sm"></i> Student Record</h5>
    <!-- <div class="row">
        <div class="col-md-2">
            <a href="?print=1" class="btn btn-success btn-sm"><i class="fas fa-print fa-sm"></i> Print view</i></a>
        </div>
    </div> -->
    <div class="table-container-listing">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th scope="col">Subject code</th>
                    <th scope="col">Description</th>
                    <th scope="col" class="text-center">Units</th>
                    <th scope="col" class="text-center">Final</th>
                    <th scope="col" class="text-center">Scale</th>
                </tr>
            </thead>
            <tbody>
                <?php $units_counter = 0; ?>
                <?php $points_counter = 0; ?>
                @foreach ($subjects as $key => $subject)
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
                            $prelim_grade = $subject->grades->where('student_id', $user->id)->where('period', 'prelim')->first()['computed_grade'];
                            $midterm_grade = $subject->grades->where('student_id', $user->id)->where('period', 'midterm')->first()['computed_grade'];
                            $final_grade = $subject->grades->where('student_id', $user->id)->where('period', 'final')->first()['computed_grade'];
                            if (!empty($prelim_grade) && !empty($midterm_grade) && !empty($final_grade)) {
                                $final = doubleval(($prelim_grade ? $prelim_grade : 0)) * doubleval('0.'.$subject->prelim) + doubleval(($midterm_grade ? $midterm_grade : 0)) * doubleval('0.'.$subject->midterm) + doubleval(($final_grade ? $final_grade : 0)) * doubleval('0.'.$subject->final);
                                $final = round($final, 2);
                                $scale = doubleval(5.00);
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
                                }
                                $units_counter += $subject->subject->units;
                                $points_counter += round(($final * $subject->subject->units),2);
                            } else {
                                $final = 'INC';
                                $scale = doubleval(5.00);
                            }
                        ?>
                        <td class="text-center">
                            {{ $final }}
                        </td>
                        <td class="text-center">
                            {{ $scale }}
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
                    <td colspan="2" >
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right text-success">
                        GWA
                    </td>
                    <td  class="text-center text-success">
                        {{ round($points_counter / $units_counter, 2) }}
                    </td>
                    <td colspan="2" >
                    </td>
                </tr>
            </tbody>
        </table>
        @if ($student->grades->count() == 0) 
            <h5><i class="fas fa-info-circle fa-sm"></i> No grades yet.</h5>
        @endif
    </div>
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