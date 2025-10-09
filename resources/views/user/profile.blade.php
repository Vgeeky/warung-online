@extends('user.layout')

@section('title', 'Profil Pengguna')

@section('content')
<div class="max-w-4xl mx-auto bg-white/10 backdrop-blur-lg p-8 rounded-2xl shadow-lg text-gray-100 border border-white/20">
    <h2 class="text-3xl font-bold mb-8 text-center text-yellow-300 tracking-wide">
        👤 Profil Pengguna
    </h2>

    <!-- Detail Profil -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm text-gray-200 mb-1">Nama Lengkap</label>
            <input type="text" value="{{ Auth::user()->name }}" 
                   class="w-full bg-white/10 border border-white/20 rounded-lg p-3 text-gray-100 focus:ring focus:ring-yellow-300/30" readonly>
        </div>

        <div>
            <label class="block text-sm text-gray-200 mb-1">Email</label>
            <input type="text" value="{{ Auth::user()->email }}" 
                   class="w-full bg-white/10 border border-white/20 rounded-lg p-3 text-gray-100 focus:ring focus:ring-yellow-300/30" readonly>
        </div>

        <div>
            <label class="block text-sm text-gray-200 mb-1">Tanggal Bergabung</label>
            <input type="text" value="{{ Auth::user()->created_at->format('d M Y') }}" 
                   class="w-full bg-white/10 border border-white/20 rounded-lg p-3 text-gray-100" readonly>
        </div>

        <div>
            <label class="block text-sm text-gray-200 mb-1">Status Akun</label>
            <input type="text" value="Aktif" 
                   class="w-full bg-green-600/30 text-green-100 border border-green-400/50 rounded-lg p-3 font-semibold" readonly>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="mt-10 flex justify-end space-x-4">
        <a href="{{ route('user.profile') }}" 
           class="px-5 py-2 bg-yellow-400 text-gray-900 font-semibold rounded-lg hover:bg-yellow-300 transition">
            Edit Profil
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="px-5 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition">
                Logout
            </button>
        </form>
    </div>
</div>
@endsection
