<h5><i class="fas fa-info-circle fa-sm"></i> Class Details</h5>
<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            <label for="code">Class code</label>
            <input id="code" type="text" name="code" placeholder="Class code" class="form-control" required>
        </div>
    </div>
</div>
<hr/>
<div class="form-group">
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('ClassesManagement') }}" class="btn btn-secondary">Back</a>
            <button class="btn btn-info" type="submit">Save</button>
        </div>
    </div>
</div>