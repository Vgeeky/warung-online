@extends('admin.layouts.app')

@section('title', 'Edit Order')

@section('content')
<div class="card shadow-sm">
  <div class="card-header bg-warning text-white">Edit Order #{{ $order->id }}</div>
  <div class="card-body">
    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
      @csrf @method('PUT')

      <div class="mb-3">
        <label class="form-label">User</label>
        <select name="user_id" class="form-select">
          @foreach ($users as $user)
            <option value="{{ $user->id }}" {{ $user->id == $order->user_id ? 'selected' : '' }}>
              {{ $user->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Status</label>
        <input type="text" name="status" value="{{ $order->status }}" class="form-control">
      </div>

      <button type="submit" class="btn btn-success">Update</button>
      <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
@endsection
