<h5><i class="fas fa-info-circle fa-sm"></i> Subject Details</h5>
<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            <label for="code">Subject code</label>
            <input id="code" type="text" name="code" placeholder="Subject code" class="form-control" required>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <label for="description">Subject description</label>
            <textarea id="description" name="description" rows="5" maxlength="191" class="form-control" placeholder="Description" required></textarea>
        </div>
    </div>
</div>
<hr/>
<div class="form-group">
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('SubjectsManagement') }}" class="btn btn-secondary">Back</a>
            <button class="btn btn-info" type="submit">Save</button>
        </div>
    </div>
</div>