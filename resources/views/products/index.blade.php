@extends('layouts.templates')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Product</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Stock</th>
                                <th>Category</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>
                                        {{-- drrop dwon --}}
                                        <a href="{{ route('products.edit', $item->id) }}" class="btn btn-warning"><i
                                                class="fas fa-edit"></i></a>
                                        {{-- show using modal --}}
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal{{ $loop->index }}"><i class="far fa-eye"></i>
                                        </button>
                                        @if ($item->products->count() < 1)
                                            <form action="{{ route('products.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
