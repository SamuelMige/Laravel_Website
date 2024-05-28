<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\hobbie;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class pageController extends Controller
{
    public function index(): View
    {
        $hobbies = hobbie::all();
        $data = page::all();

        return view('items.index', compact('hobbies', 'data'));
    }
    public function edit($id=2): View
    {
        // Temukan hobby berdasarkan ID
        $data = page::findOrFail($id);

        // Mengembalikan tampilan edit dengan data hobi
        return view('items.edit', compact('data'));
    }
    public function update(Request $request, $id=2): RedirectResponse
    {
        // Validasi form
        $validator = Validator::make($request->all(), [
            'user' => 'required|string|max:255',
            'introduction' => 'required|string',
            'description' => 'required|string',
            'logo' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
            'background' => 'image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = page::findOrFail($id);

        $data->user = $request->user;
        $data->introduction = $request->introduction;
        $data->description = $request->description;

        // Periksa apakah ada gambar baru untuk logo
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            // Hapus gambar lama jika ada
            if ($data->logo && Storage::exists('public/image/' . $data->logo)) {
                Storage::delete('public/image/' . $data->logo);
            }
            // Simpan gambar baru
            $logoPath = $logo->store('public/image');
            $data->logo = basename($logoPath);
        }

        // Periksa apakah ada gambar baru untuk background
        if ($request->hasFile('background')) {
            $background = $request->file('background');
            // Hapus gambar lama jika ada
            if ($data->background && Storage::exists('public/background/' . $data->background)) {
                Storage::delete('public/background/' . $data->background);
            }
            // Simpan gambar baru
            $backgroundPath = $background->store('public/background');
            $data->background = basename($backgroundPath);
        }

        // Simpan perubahan
        $data->save();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->back()->with('success', 'p');
    }
}
