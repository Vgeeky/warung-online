@extends('admin.app')

@section('title', 'Add Product')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">Back to Products</a>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="form-group">
                <label for="name">Name <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="price">Price <span class="text-danger">*</span></label>
                    <input type="number" id="price" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="stock">Stock <span class="text-danger">*</span></label>
                    <input type="number" id="stock" name="stock" class="form-control" value="{{ old('stock') }}" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id" class="form-control">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary">Save Product</button>

        </div>
    </div>
</form>
@endsection
