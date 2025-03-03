@extends('layouts.app')

@section('content')
<div class="grades-management">
    <div class="filter-container mb-3 hide-on-print">
        @if ($subjects->count())
        <form action="{{ route('GradesManagement') }}" method="get">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-8">
                        <label for="subject">Please select subject.</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="select2-container">
                            <select id="subject" name="subject" class="form-control select2 submit-on-change" required>
                                <option value="">Select Subject</option>
                                @foreach ($subjects as $key => $cs)
                                    <option value="{{ @$cs->id }}" {{ @$data->id == $cs->id ? 'selected' : '' }}>{{ @$cs->subject->code . ' - ' . @$cs->subject->description . ' (Class : ' . $cs->class->code . ' - ' . @$cs->class->semester->name . ' - ' . @$cs->class->year_level->name . ')' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-2">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-user-graduate fa-sm"></i> View Students <i class="fas fa-arrow-right fa-sm"></i></button>
                    </div> -->
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="period">Period</label>
                        <select name="period" class="form-control submit-on-change">
                            <option value="prelim" {{ @$period == 'prelim' ? 'selected' : '' }}>Prelim</option>
                            <option value="midterm" {{ @$period == 'midterm' ? 'selected' : '' }}>Midterm</option>
                            <option value="final" {{ @$period == 'final' ? 'selected' : '' }}>Final</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        @else
        <h5><i class="fas fa-info-circle fa-sm"></i> No Manageable Subjects Found</h5>
        @endif
    </div>
    
    @if (!empty($students) && $students->count())
    <h5><i class="fas fa-list fa-sm"></i> Students list</h5>
    <!-- <a href="{{ route('ManageClassStudent', [$data->class_id]) }}" class="btn btn-info btn-sm"><i class="fas fa-user-graduate fa-sm"></i> Manage Class Students</a> -->
    <div class="table-container-listing">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col" style="width: 80px">ID No.</th>
                    <th scope="col">Name</th>
                    @if (!empty($data->computations->where('period' , !empty($period) ? $period : 'prelim')))
                        @foreach ($data->computations->where('period' , !empty($period) ? $period : 'prelim') as $key => $computation)
                            <th scope="col">{{ $computation->name . ' (' . $computation->value .'%)' }}</th>
                        @endforeach
                    @endif
                    <th scope="col" class="text-center">Result</th>
                    <th scope="col" style="min-width:140px">Remarks</th>
                    <th scope="col" class="text-center" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $key => $d)
                    <tr class="computation-container">
                        <th scope="row">
                            <form id="form{{$key}}" class="ajax-submit" action="{{ route('AssignGrades', [$data->id]) }}" method="post">
                                <input type="hidden" name="classes_subject_id" value="{{ $data->id }}">
                                <input type="hidden" name="student_id" value="{{ $d->student->id }}">
                                <input type="hidden" name="period" value="{{ !empty($period) ? $period : 'prelim' }}">
                            </form>
                            <form id="dropForm{{$key}}" class="ajax-submit" action="{{ route('AssignGrades', [$data->id]) }}" method="post" confirmation="true" confirmation-note="Once dropped, you can still put this student back to this class subject." confirmation-cancelled-note="Student remain active.">
                                <input type="hidden" name="classes_subject_id" value="{{ $data->id }}">
                                <input type="hidden" name="student_id" value="{{ $d->student->id }}">
                                <input type="hidden" name="period" value="{{ !empty($period) ? $period : 'prelim' }}">
                                <input type="hidden" name="remarks" value="drop">
                            </form>
                            {{ $d->student->username }}
                        </th>
                        <td>
                            {{ $d->student->name }}
                        </td>
                        <?php $grade = $d->student->grades->where('classes_subject_id', $data->id)->where('period', !empty($period) ? $period : 'prelim')->first(); ?>
                        @if (!empty($data->computations->where('period' , !empty($period) ? $period : 'prelim')))
                            @foreach ($data->computations->where('period' , !empty($period) ? $period : 'prelim') as $computation_key => $computation)
                                <?php unset($grades_item); if (!empty($grade)) {$grades_item = $grade->items->where('computation_id', $computation->id)->first();} ?>
                                <td>
                                    <input value="{{!empty($grades_item->value) || isset($grades_item) && $grades_item->value == 0 ? $grades_item->value : 0}}" name="computations[{{ $computation->id }}]" min="0" max="100" form="form{{$key}}" type="number" step="any" class="form-control decimal-input computation-input" computaion-value="{{ $computation->value }}" required>
                                </td>
                            @endforeach
                        @endif
                        <td class="text-center result-container">
                            {{ !empty($grade) ? $grade->computed_grade : 0 }}
                        </td>
                        <td>
                            <select name="remarks" form="form{{$key}}" class="form-control">
                                <option value="">No remarks</option>
                                <option value="incomplete" {{!empty($grade->remarks) && $grade->remarks == 'incomplete' ? 'selected' : ''}}>Incomplete</option>
                                <!-- <option value="drop" {{!empty($grade->remarks) && $grade->remarks == 'drop' ? 'selected' : ''}}>Drop</option> -->
                            </select>
                        </td>
                        <td class="text-center">
                            <button form="form{{$key}}" class="btn btn-success btn-sm" type="submit">Submit</button>
                        </td>
                        <td class="text-center">
                            <button form="dropForm{{$key}}" class="btn btn-danger btn-sm" type="submit">Drop</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @elseif ($subjects->count()) 
    <h5><i class="fas fa-info-circle fa-sm"></i> No Students Found</h5>
    @endif
    
    @if (!empty($drop_students) && $drop_students->count())
    <h5><i class="fas fa-list fa-sm"></i> Droppped list</h5>
    <div class="table-container-listing">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col" style="width: 80px">ID No.</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Middle Name</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($drop_students as $key => $ds)
                    <tr class="computation-container">
                        <th scope="row">
                            <form id="putBackForm{{$key}}" class="ajax-submit" action="{{ route('AssignGrades', [$data->id]) }}" method="post" confirmation="true" confirmation-note="Once put back, you can manage this student grades for this class subject." confirmation-cancelled-note="Student remain dropped.">
                                <input type="hidden" name="classes_subject_id" value="{{ $data->id }}">
                                <input type="hidden" name="student_id" value="{{ $ds->student->id }}">
                                <input type="hidden" name="period" value="{{ !empty($period) ? $period : 'prelim' }}">
                                <input type="hidden" name="remarks" value="putback">
                            </form>
                            {{ $ds->student->username }}
                        </th>
                        <td>
                            {{ $ds->student->last_name }}
                        </td>
                        <td>
                            {{ $ds->student->first_name }}
                        </td>
                        <td>
                            {{ $ds->student->middle_name }}
                        </td>
                        <td class="text-center">
                            <button form="putBackForm{{$key}}" class="btn btn-success btn-sm" type="submit"><i class="fas fa-arrow-up"></i> Put back to class</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@stop
@include('admin.helper.form-helper')
@section('added-scripts')
<script>
    $(document).ready(function() {
        $('input.computation-input').on('change', function  () {
            var container = $(this).closest('.computation-container');
            var result = 0;
            container.find('input.computation-input').each(function () {
                var value = $(this).val().length ? parseFloat($(this).val()).toFixed(2) : 0;
                var computationValue = parseInt($(this).attr('computaion-value'));
                var computed = parseFloat(value) * parseFloat('0.'+computationValue)
                result += computed;
            });
            container.find('.result-container').html(parseFloat(result).toFixed(2));
        });
        $('.submit-on-change').on('change', function () {
            $(this).closest('form').submit();
        });
    });
</script>
@stop