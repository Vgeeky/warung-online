@extends('layouts.user')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-8 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold text-green-600 mb-6">👤 Profil Pengguna</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-gray-600 mb-2 font-medium">Nama Lengkap</label>
            <input type="text" value="{{ Auth::user()->name }}" 
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring focus:ring-green-200" readonly>
        </div>

        <div>
            <label class="block text-gray-600 mb-2 font-medium">Email</label>
            <input type="text" value="{{ Auth::user()->email }}" 
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring focus:ring-green-200" readonly>
        </div>

        <div>
            <label class="block text-gray-600 mb-2 font-medium">Tanggal Bergabung</label>
            <input type="text" value="{{ Auth::user()->created_at->format('d M Y') }}" 
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring focus:ring-green-200" readonly>
        </div>

        <div>
            <label class="block text-gray-600 mb-2 font-medium">Status Akun</label>
            <input type="text" value="Aktif" 
                   class="w-full border border-gray-300 rounded-lg p-3 text-green-600 font-semibold" readonly>
        </div>
    </div>

    <div class="mt-8 flex justify-end space-x-4">
        <a href="{{ route('profile.edit') }}" 
           class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Edit Profil</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                Logout
            </button>
        </form>
    </div>
</div>
@endsection
