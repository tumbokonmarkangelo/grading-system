<h5><i class="fas fa-list fa-sm"></i> Students list</h5>
<div class="form-group template-destination">
    <div class="row">
        <div class="col-md-1">
            <label>ID</label>
        </div>
        <div class="col-md-4">
            <label>Student Name</label>
        </div>
        <div class="col-md-4">
            <label>Student Status</label>
        </div>
        <div class="col-md-3 text-center">
            <label>Action</label>
        </div>
    </div>
    @if ($data->students->count())
        @foreach ($data->students as $key => $cs)
        <div class="row mt-2 action-coverage">
            <div class="col-md-1">
                <input type="text" name="id[]" placeholder="Auto Generate" class="form-control readonly-input" value="{{ $cs->id }}" required readonly disabled>
                <input type="hidden" name="class_id[]" value="{{ $data->id }}" disabled>
            </div>
            <div class="col-md-4 select2-container">
                @if (!empty($user = Auth::user()) && $user->type == 'admin')
                    <select type="text" name="student_id[]" placeholder="Select Student" class="form-control select2" required disabled>
                        <option value="">Select Student</option>
                        @if ($students->count())
                            @foreach ($students as $key => $student)
                                <option value="{{ $student->id }}" {{ $cs->student_id == $student->id ? 'selected' : '' }}>{{ $student->username . ' : ' . $student->name, 30 }}</option>
                            @endforeach
                        @endif
                    </select>
                @else
                    <input type="text" class="form-control readonly-input" value="{{ $cs->student->name }}" required readonly disabled>
                    <input type="hidden" name="student_id[]" value="{{ $cs->student_id }}" required disabled>
                @endif
            </div>
            <div class="col-md-4 select2-container">
                <select name="status[]" class="form-control select2" required disabled>
                    <option value="active" {{!empty($cs->status) && $cs->status == 'active' ? 'selected' : ''}}>Active</option>
                    <option value="drop" {{!empty($cs->status) && $cs->status == 'drop' ? 'selected' : ''}}>Drop from class</option>
                </select>
            </div>
            <div class="col-md-3 text-center action-container">
                <button class="btn btn-success btn-sm" type="button" value="edit"><span class="default-view">Edit</span><span class="switch-view"><i class="fas fa-times fa-sm"></i> Edit</span></button>
                <button class="btn btn-danger btn-sm" type="button" value="delete"><span class="default-view">Delete</span><span class="switch-view"><i class="fas fa-times fa-sm"></i> Delete</span></button>
                <input type="hidden" name="action[]" class="action-input readonly-input" disabled>
            </div>
        </div>
        @endforeach
    @endif
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <button type="button" class="btn btn-success add-row"><i class="fas fa-plus"></i> Add new Student</button>
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
            <select type="text" name="student_id[]" placeholder="Select Student" class="form-control select2-on-template" required disabled>
                <option value="">Select Student</option>
                @if ($students->count())
                    @foreach ($students as $key => $student)
                        <option value="{{ $student->id }}">{{ $student->username . ' : ' . $student->name, 30 }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-md-4">
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