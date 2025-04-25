<table class="table table-borderless table-hover datatable">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Full Name</th>
        <th scope="col">Email</th>
        <th scope="col">Type of user</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody id="usersContent">
    @foreach($users as $user)
            <tr class="align-middle">
                <td>{{ $user->id }}</td>
                <td><img src="{{asset('assets/img/users/'.$user->image)}}" alt="Profile" class="img-fluid img-thumbnail w-25 rounded-circle d-none d-sm-inline">{{ $user->first_name . ' ' . $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <td>
                    <a href="{{route('dashboard.user.edit', ['id' => $user->id])}}" class="btn btn-dark">
                        <i class="ri-edit-line"></i>
                    </a>
                </td>
                <td>
                    <form action="{{route('dashboard.user.delete', ['id' => $user->id])}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
    @endforeach
    </tbody>
</table>
<div id="paginationContainer">
    {{ $users->links() }}
</div>
