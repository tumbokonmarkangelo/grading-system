<h5><i class="fas fa-list fa-sm"></i> Criteria list</h5>
<div class="form-group template-destination">
    <div class="row">
        <div class="col-md-1">
            <label>ID</label>
        </div>
        <div class="col-md-3">
            <label>Name</label>
        </div>
        <div class="col-md-3">
            <label>Description</label>
        </div>
        <div class="col-md-2">
            <label>Value (%)</label>
        </div>
        @if ($grade_count == 0)
        <div class="col-md-3 text-center">
            <label>Action</label>
        </div>
        @endif
    </div>
    @if ($data->computations->count())
        @foreach ($data->computations as $key => $computation)
        <div class="row mt-2 action-coverage">
            <div class="col-md-1">
                <input type="text" name="id[]" placeholder="Auto Generate" class="form-control readonly-input" value="{{ $computation->id }}" required readonly disabled>
                <input type="hidden" name="classes_subject_id[]" value="{{ $data->id }}" disabled>
            </div>
            <div class="col-md-3">
                <input id="name" type="text" name="name[]" placeholder="Criteria Name" class="form-control" value="{{ $computation->name }}" required disabled>
            </div>
            <div class="col-md-3">
                <input id="description" type="text" name="description[]" placeholder="Criteria Description" class="form-control" value="{{ $computation->description }}" disabled>
            </div>
            <div class="col-md-2">
                <input id="value" min="1" max="100" type="number" name="value[]" placeholder="Criteria Value" class="form-control" default-value="{{ $computation->value }}" value="{{ $computation->value }}" required disabled>
            </div>
            @if ($grade_count == 0)
            <div class="col-md-3 text-center action-container">
                <button class="btn btn-success btn-sm" type="button" value="edit"><span class="default-view">Edit</span><span class="switch-view"><i class="fas fa-times fa-sm"></i> Edit</span></button>
                <button class="btn btn-danger btn-sm" type="button" value="delete"><span class="default-view">Delete</span><span class="switch-view"><i class="fas fa-times fa-sm"></i> Delete</span></button>
                <input type="hidden" name="action[]" class="action-input readonly-input" disabled>
            </div>
            @endif
        </div>
        @endforeach
    @endif
</div>
@if ($grade_count == 0)
<div class="row">
    <div class="col-md-12 text-center">
        <button type="button" class="btn btn-success add-row"><i class="fas fa-plus"></i> Add new Criteria</button>
    </div>
</div>
@endif
<hr/>
<div class="form-group">
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('ManageClassSubject', [$data->class_id]) }}" class="btn btn-secondary">Back</a>
            @if ($grade_count == 0)
                <button class="btn btn-info" type="submit">Save</button>
            @endif
        </div>
    </div>
</div>

<div class="row-template-container">
    <div class="row mt-2 action-coverage template">
        <div class="col-md-1">
            <input type="text" name="id[]" placeholder="" class="form-control readonly-input" required readonly disabled>
            <input type="hidden" name="classes_subject_id[]" value="{{ $data->id }}" disabled>
        </div>
        <div class="col-md-3">
            <input id="name" type="text" name="name[]" placeholder="Criteria Name" class="form-control" required disabled>
        </div>
        <div class="col-md-3">
            <input id="description" type="text" name="description[]" placeholder="Criteria Description" class="form-control" disabled>
        </div>
        <div class="col-md-2">
            <input id="value" min="1" max="100" type="number" name="value[]" placeholder="Criteria Value" class="form-control" required disabled>
        </div>
        <div class="col-md-3 text-center action-container">
            <button class="btn btn-danger btn-sm" type="button" value="remove">Remove</button>
        </div>
    </div>
</div>
@section('added-scripts')
<script>
    $(document).ready(function() {
        @if ($grade_count > 0)
            swal({
                title: "This computations is used",
                text:  "Edit capability for disabled.",
                icon: "info",
                dangerMode: true,
            })
        @endif
    });
</script>
@stop