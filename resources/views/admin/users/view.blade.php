<div class="profile-table mt-4">
    <table class="table-dark table-bordered table-sm">
        <tbody>
            <tr>
                <td scope="row"><b>ID Number</b></td>
                <td>{{ $user->username }}</td>
            </tr>
            <tr>
                <td scope="row"><b>Name</b></td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td scope="row"><b>Email</b></td>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <td scope="row"><b>Type</b></td>
                <td>{{ ucfirst($user->type) }}</td>
            </tr>
            @if ($user->type == 'student')
            <tr>
                <td scope="row"><b>Course</b></td>
                <td>{{ @$user->course }}</td>
            </tr>
            <tr>
                <td scope="row"><b>Year Level</b></td>
                <td>{{ @$user->year_level->name }}</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>