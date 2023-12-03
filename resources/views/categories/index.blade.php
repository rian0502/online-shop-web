@extends('layouts.templates')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Category</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Barang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->products->count() }}</td>
                                    <td>
                                        {{-- drrop dwon --}}
                                        <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-warning"><i
                                                class="fas fa-edit"></i></a>
                                        {{-- show using modal --}}
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal{{ $loop->index }}"><i class="far fa-eye"></i>
                                        </button>
                                        @if ($item->products->count() < 1)
                                            <form action="{{ route('categories.destroy', $item->id) }}" method="POST"
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
