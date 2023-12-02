@extends('layouts.templates')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('products.index') }}" class="btn btn-danger"><i class="fas fa-chevron-circle-left"></i>
                        Back</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="categoryname">Product Name</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                        id="categoryname" value="{{ old('name') }}" name="name">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control select2" style="width: 100%;" name="category_id">
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="categoryname">Product Description</label>
                                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" rows="3" name="description">{{ old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="categoryname">Stock</label>
                                    <input type="number" min="0"
                                        class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}"
                                        id="categoryname" value="{{ old('name') }}" name="stock">
                                    @if ($errors->has('stock'))
                                        <span class="text-danger">{{ $errors->first('stock') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="categoryname">Price</label>
                                    <input type="number" min="0"
                                        class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                        id="categoryname" value="{{ old('price') }}" name="price">
                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="categoryname">Discount</label>
                                    <input type="number" min="0"
                                        class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}"
                                        id="categoryname" value="{{ old('name') }}" name="discount">
                                    @if ($errors->has('discount'))
                                        <span class="text-danger">{{ $errors->first('discount') }}</span>
                                    @endif
                                </div>
                            </div>
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
