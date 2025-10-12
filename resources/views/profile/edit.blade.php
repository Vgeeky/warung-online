@extends('user.layout')

@section('title', 'Profil')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #007bff, #6610f2);
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
        color: #f0f3ff;
    }

    .profile-container {
        max-width: 700px;
        margin: 3rem auto;
        padding: 2rem;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 1rem;
        color: #fff;
    }

    h1 {
        text-align: center;
        font-weight: 700;
        margin-bottom: 2rem;
        letter-spacing: 1px;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
    }

    label {
        font-weight: 500;
        color: #e0e7ff;
    }

    input {
        width: 100%;
        padding: 0.75rem;
        margin-top: 0.25rem;
        border: none;
        border-radius: 0.5rem;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        font-weight: 500;
    }

    input[readonly] {
        background: rgba(255, 255, 255, 0.15);
        cursor: not-allowed;
    }

    input:focus {
        outline: none;
        background: rgba(255, 255, 255, 0.35);
    }

    .btn-primary, .btn-secondary, .btn-danger {
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        transition: 0.3s;
        width: 100%;
        margin-top: 1rem;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(90deg, #ff9100, #ffb84d);
    }
    .btn-primary:hover {
        transform: scale(1.05);
        filter: brightness(1.1);
    }

    .btn-secondary {
        background: linear-gradient(90deg, #2196f3, #64b5f6);
    }

    .btn-danger {
        background: linear-gradient(90deg, #e53935, #ef5350);
    }

    .alert-success {
        background: rgba(56, 142, 60, 0.3);
        border: 1px solid rgba(56, 142, 60, 0.5);
        color: #e8ffe8;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }
</style>

<div class="profile-container">
    <h1>Profil Saya</h1>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- Mode lihat profil --}}
    <div id="view-mode">
        <div class="mb-4">
            <label>Nama</label>
            <input type="text" value="{{ auth()->user()->name }}" readonly>
        </div>
        <div class="mb-4">
            <label>Email</label>
            <input type="text" value="{{ auth()->user()->email }}" readonly>
        </div>

        <button type="button" id="edit-btn" class="btn-secondary">Edit Profil</button>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-danger">Logout</button>
        </form>
    </div>

    {{-- Mode edit profil --}}
    <div id="edit-mode" style="display: none;">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="name">Nama</label>
                <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}" required>
            </div>

            <div class="mb-4">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}" required>
            </div>

            <div class="mb-4">
                <label for="password">Password Baru (opsional)</label>
                <input id="password" name="password" type="password">
            </div>

            <div class="mb-4">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password">
            </div>

            <button type="submit" class="btn-primary">Simpan Perubahan</button>
            <button type="button" id="cancel-edit" class="btn-secondary">Batal</button>
        </form>
    </div>
</div>

<script>
    // JavaScript untuk toggle antara mode lihat dan edit
    document.getElementById('edit-btn').addEventListener('click', () => {
        document.getElementById('view-mode').style.display = 'none';
        document.getElementById('edit-mode').style.display = 'block';
    });

    document.getElementById('cancel-edit').addEventListener('click', () => {
        document.getElementById('edit-mode').style.display = 'none';
        document.getElementById('view-mode').style.display = 'block';
    });
</script>
@endsection
