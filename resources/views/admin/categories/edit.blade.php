@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Kategori</h1>

    <div class="card shadow mb-4 p-4">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama Kategori</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $category->name) }}"
                    class="form-control"
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary mt-3">Perbarui</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
</div>
@endsection
