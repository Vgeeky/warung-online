@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Upload Gambar QRIS</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.qris.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="qris_image" class="form-label">Pilih Gambar QRIS</label>
            <input type="file" class="form-control" name="qris_image" id="qris_image" required>
        </div>

        @if($qris)
            <p>Gambar Saat Ini:</p>
            <img src="{{ asset('storage/'.$qris) }}" alt="QRIS" style="width:200px;">
        @endif

        <button type="submit" class="btn btn-primary mt-2">Simpan</button>
    </form>
</div>
@endsection
