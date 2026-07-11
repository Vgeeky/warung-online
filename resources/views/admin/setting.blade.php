@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Upload QRIS</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Gambar QRIS:</label><br>
            @if($qris && $qris->value)
                <img src="{{ asset('storage/'.$qris->value) }}" alt="QRIS" width="200" class="mb-2"><br>
            @endif
            <input type="file" name="qris_image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
