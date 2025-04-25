<table class="table table-borderless datatable">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody id="specializationsContent">
    @foreach($specializations as $s)
        <tr class="align-middle">
            <td>{{$s->id}}</td>
            <td>{{$s->name}}</td>
            <td>
                <a href="{{ route('dashboard.specialization.edit', ['id' => $s->id]) }}" class="btn btn-dark">
                    <i class="ri-edit-line"></i>
                </a>
            </td>
            <td>
                <form action="{{route('dashboard.specialization.delete', ['id' => $s->id])}}" method="POST">
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
    {{ $specializations->links() }}
</div>
