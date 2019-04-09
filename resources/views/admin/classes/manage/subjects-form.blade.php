<h5><i class="fas fa-list fa-sm"></i> Subjects list</h5>
<div class="form-group template-destination">
    <div class="row">
        <div class="col-md-1">
            <label>ID</label>
        </div>
        <div class="col-md-4">
            <label>Subject</label>
        </div>
        <div class="col-md-4">
            <label>Teacher</label>
        </div>
        <div class="col-md-3 text-center">
            <label>Action</label>
        </div>
    </div>
    @if ($data->subjects->count())
        @foreach ($data->subjects as $key => $cs)
        <div class="row mt-2 action-coverage">
            <div class="col-md-1">
                <input type="text" name="id[]" placeholder="Auto Generate" class="form-control readonly-input" value="{{ $cs->id }}" required readonly disabled>
                <input type="hidden" name="class_id[]" value="{{ $data->id }}" disabled>
            </div>
            <div class="col-md-4 select2-container">
                <select type="text" name="subject_id[]" placeholder="Select Subject" class="form-control select2" required disabled>
                    <option value="">Select Subject</option>
                    @if ($subjects->count())
                        @foreach ($subjects as $key => $subject)
                            <option value="{{ $subject->id }}" {{ $cs->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->code . ' - ' .str_limit($subject->description, 30) }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-md-4 select2-container">
                <select type="text" name="teacher_id[]" placeholder="Select Teacher" class="form-control select2" required disabled>
                    <option value="">Select Teacher</option>
                    @if ($teachers->count())
                        @foreach ($teachers as $key => $teacher)
                            <option value="{{ $teacher->id }}" {{ $cs->teacher_id == $teacher->id ? 'selected' : '' }}>{{ $teacher->name, 30 }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-md-3 text-center action-container">
                <button class="btn btn-success btn-sm" type="button" value="edit"><span class="default-view">Edit</span><span class="switch-view"><i class="fas fa-times fa-sm"></i> Edit</span></button>
                <button class="btn btn-danger btn-sm" type="button" value="delete"><span class="default-view">Delete</span><span class="switch-view"><i class="fas fa-times fa-sm"></i> Delete</span></button>
                <input type="hidden" name="action[]" class="action-input readonly-input" disabled>
                <a href="{{ route('ManageClassSubjectComputaion', [$cs->id]) }}" class="btn btn-info btn-sm">Computation</a>
            </div>
        </div>
        @endforeach
    @endif
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <button type="button" class="btn btn-success add-row"><i class="fas fa-plus"></i> Add new Subject</button>
    </div>
</div>
<hr/>
<div class="form-group">
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('EditClass', [$data->id]) }}" class="btn btn-secondary">Back</a>
            <button class="btn btn-info" type="submit">Save</button>
        </div>
    </div>
</div>

<div class="row-template-container">
    <div class="row mt-2 action-coverage template">
        <div class="col-md-1">
            <input type="text" name="id[]" placeholder="" class="form-control readonly-input" required readonly disabled>
            <input type="hidden" name="class_id[]" value="{{ $data->id }}" disabled>
        </div>
        <div class="col-md-4 select2-container">
            <select type="text" name="subject_id[]" placeholder="Select Subject" class="form-control select2-on-template" required disabled>
                <option value="">Select Subject</option>
                @if ($subjects->count())
                    @foreach ($subjects as $key => $subject)
                        <option value="{{ $subject->id }}">{{ $subject->code . ' - ' .str_limit($subject->description, 30) }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-md-4 select2-container">
            <select type="text" name="teacher_id[]" placeholder="Select Teacher" class="form-control select2-on-template" required disabled>
                <option value="">Select Teacher</option>
                @if ($teachers->count())
                    @foreach ($teachers as $key => $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name, 30 }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-md-3 text-center action-container">
            <button class="btn btn-danger btn-sm" type="button" value="remove">Remove</button>
        </div>
    </div>
</div>
@section('added-scripts')
<script>
    $(document).ready(function() {

    });
</script>
@stop