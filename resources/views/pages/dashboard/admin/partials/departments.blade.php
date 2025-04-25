<table class="table table-borderless datatable">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Image</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody id="departmentsContent">
    @foreach($departments as $d)
        <tr class="align-middle">
            <td>{{$d->id}}</td>
            <td>{{$d->name}}</td>
            <td>{{$d->description}}</td>
            <td><img src="{{asset('assets/img/'.$d->image)}}" alt="" class="img-fluid"></td>
            <td>
                <a href="{{route('dashboard.department.edit', ['id' => $d->id])}}" class="btn btn-dark">
                    <i class="ri-edit-line"></i>
                </a>
            </td>
            <td>
                <form action="{{route('dashboard.department.delete', ['id' => $d->id])}}" method="POST">
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
    {{ $departments->links() }}
</div>
