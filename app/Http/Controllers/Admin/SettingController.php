<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;

class SettingController extends Controller
{
    public function edit()
    {
        $qris = Setting::where('key', 'qris_image')->first();
        return view('admin.setting', compact('qris'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'qris_image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($request->hasFile('qris_image')) {
            $path = $request->file('qris_image')->store('uploads/qris', 'public');

            Setting::updateOrCreate(
                ['key' => 'qris_image'],
                ['value' => $path]
            );
        }

        return back()->with('success', 'QRIS berhasil diperbarui!');
    }
}
