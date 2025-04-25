<table class="table table-borderless datatable">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Type</th>
        <th scope="col">Description</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody id="medicationsContent">
    @foreach($medications as $m)
        <tr class="align-middle">
            <td>{{$m->id}}</td>
            <td>{{$m->name}}</td>
            <td>{{$m->type}}</td>
            <td>{{$m->description}}</td>
            <td>
                <a href="{{route('dashboard.medication.edit', ['id' => $m->id])}}" class="btn btn-dark">
                    <i class="ri-edit-line"></i>
                </a>
            </td>
            <td>
                <form action="{{route('dashboard.medication.delete', ['id' => $m->id])}}" method="POST">
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
    {{ $medications->links() }}
</div>
