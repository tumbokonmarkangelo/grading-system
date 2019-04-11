@extends('layouts.app')

@section('content')
<div class="grades-management">
    <div class="filter-container mb-3">
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
        <h5><i class="fas fa-info-circle fa-sm"></i> No Assigned Subjects</h5>
        </div>
        @endif
    </div>
    
    @if (!empty($students) && $students->count())
    <h5><i class="fas fa-list fa-sm"></i> Students list</h5>
    <div class="table-container-listing">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">ID/Username</th>
                    <th scope="col">Name</th>
                    @if (!empty($data->computations->where('period' , !empty($period) ? $period : 'prelim')))
                        @foreach ($data->computations->where('period' , !empty($period) ? $period : 'prelim') as $key => $computation)
                            <th scope="col">{{ $computation->name . ' (' . $computation->value .'%)' }}</th>
                        @endforeach
                    @endif
                    <th scope="col" class="text-center">Result</th>
                    <th scope="col" class="text-center">Action</th>
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
                                    <input value="{{!empty($grades_item->value) ? $grades_item->value: ''}}" name="computations[{{ $computation->id }}]" min="1" max="100" form="form{{$key}}" type="number" step="any" class="form-control decimal-input computation-input" computaion-value="{{ $computation->value }}" required>
                                </td>
                            @endforeach
                        @endif
                        <td class="text-center result-container">
                            {{ !empty($grade) ? $grade->computed_grade : 0 }}
                        </td>
                        <td class="text-center">
                            <button form="form{{$key}}" class="btn btn-success btn-sm" type="submit">Submit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <h5><i class="fas fa-info-circle fa-sm"></i> No Assigned Students</h5>
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