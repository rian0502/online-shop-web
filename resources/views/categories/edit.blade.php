@extends('layouts.templates')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('categories.index') }}" class="btn btn-danger"><i class="fas fa-chevron-circle-left"></i>
                        Back</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="categoryname">Category Name</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                id="categoryname" placeholder="ex: Software" value="{{ old('name', $category->name) }}"
                                name="name">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="categoryname">Category Description</label>
                            <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" rows="3"
                                placeholder="ex: Software is..." name="description">{{ old('description', $category->description) }}</textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
