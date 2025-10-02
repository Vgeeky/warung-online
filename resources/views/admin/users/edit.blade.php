@extends('admin.app')
@section('title','Edit User')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">Back</a>
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

<form action="{{ route('admin.users.update',$user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name',$user->name) }}" required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email',$user->email) }}" required>
    </div>

    <div class="form-group">
        <label>Password <small>(Leave blank if not change)</small></label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>

    <div class="form-group">
    <label>Role</label>
    <select name="role" class="form-control" required>
        <option value="user" {{ old('role')=='user'?'selected':'' }}>User</option>
        <option value="admin" {{ old('role')=='admin'?'selected':'' }}>Admin</option>
    </select>
    </div>


    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection
