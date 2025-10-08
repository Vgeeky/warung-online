@extends('admin.layouts.app')

@section('title', 'Tambah Order')

@section('content')
<div class="card shadow-sm">
  <div class="card-header bg-primary text-white">Tambah Order Baru</div>
  <div class="card-body">
    <form action="{{ route('admin.orders.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label class="form-label">User</label>
        <select name="user_id" class="form-select" required>
          <option value="">-- Pilih User --</option>
          @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Status</label>
        <input type="text" name="status" class="form-control" placeholder="misal: pending" required>
      </div>

      <button type="submit" class="btn btn-success">Simpan</button>
      <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
@endsection
