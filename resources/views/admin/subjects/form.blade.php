<h5><i class="fas fa-info-circle fa-sm"></i> Subject Details</h5>
<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            <label for="code">Subject code</label>
            <input id="code" type="text" name="code" placeholder="Subject code" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label for="name">Subject name</label>
            <input id="name" type="text" name="name" placeholder="Subject name" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label for="units">Units</label>
            <input min="1" max="10" id="units" type="number" name="units" placeholder="Units" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label for="semester_id">Semester</label>
            <select id="semester_id" name="semester_id" class="form-control" required>
                @foreach ($semesters as $key => $semester)
                    <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="year_id">Year Level</label>
            <select id="year_id" name="year_id" class="form-control" required>
                @foreach ($year_levels as $key => $year_level)
                    <option value="{{ $year_level->id }}">{{ $year_level->name }}</option>
                @endforeach
            </select>
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