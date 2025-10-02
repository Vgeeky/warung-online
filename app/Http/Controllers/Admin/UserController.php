<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->latest()->paginate(10); // hanya user biasa
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:100',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>'user',
        ]);

        return redirect()->route('admin.users.index')->with('success','User created.');
    }

    public function edit(User $user)
    {
        if($user->role !== 'user') abort(403); // admin tidak bisa edit admin lain
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if($user->role !== 'user') abort(403);

        $request->validate([
            'name'=>'required|string|max:100',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'password'=>'nullable|string|min:6|confirmed',
        ]);

        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
        ];

        if($request->filled('password')){
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success','User updated.');
    }

    public function destroy(User $user)
    {
        if($user->role !== 'user') abort(403);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success','User deleted.');
    }
}
