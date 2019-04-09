<h5><i class="fas fa-info-circle fa-sm"></i> Class Details</h5>
<div class="form-group">
    <div class="row">
        <div class="col-md-4">
            <label for="code">Class code</label>
            <input id="code" type="text" name="code" placeholder="Class code" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label for="semester_id">Semester</label>
            <select id="semester_id" name="semester_id" class="form-control">
                @foreach ($semesters as $key => $semester)
                    <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="year_id">Year Level</label>
            <select id="year_id" name="year_id" class="form-control">
                @foreach ($year_levels as $key => $year_level)
                    <option value="{{ $year_level->id }}">{{ $year_level->name }}</option>
                @endforeach
            </select>
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