<?php
namespace App\Http\Controllers;

use App\Models\hobbie;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class HobbyController extends Controller
{
    public function index(): View
    {
        // Mengambil semua data hobi
        $hobbies = hobbie::all();
        $data = page::all();

        // Mengembalikan tampilan dengan data hobi
        return view('items.index', compact('hobbies','data'));
    }
    public function main(): View
    {
        // Mengambil semua data hobi
        $hobbies = hobbie::all();
        $data = page::all();

        // Mengembalikan tampilan dengan data hobi
        return view('hobbies.index', compact('hobbies','data'));
    }

    public function create(): View
    {
        return view('hobbies.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/images', $image->hashName());
            $imagePath = $image->hashName();
        } else {
            $imagePath = null;
        }

        // Simpan data ke dalam database
        hobbie::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('hobbies.main')->with('success', 'Hobby added successfully!');
    }

    public function edit($id): View
    {
        // Temukan hobby berdasarkan ID
        $hobby = hobbie::findOrFail($id);

        // Mengembalikan tampilan edit dengan data hobi
        return view('hobbies.edit', compact('hobby'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|',
            'image' => '|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        // Temukan hobby berdasarkan ID
        $hobby = hobbie::findOrFail($id);

        // Perbarui data hobi
        $hobby->name = $request->name;
        $hobby->description = $request->description;

        // Periksa apakah ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($hobby->image) {
                Storage::delete('public/images/' . $hobby->image);
            }

            // Upload gambar baru
            $image = $request->file('image');
            $image->storeAs('public/images', $image->hashName());
            $hobby->image = $image->hashName();
        }

        // Simpan perubahan
        $hobby->save();

        // Redirect ke halaman index 
        return redirect()->back()->with('success', 'p');
    }

    public function destroy($id): RedirectResponse
    {
        // Temukan hobby berdasarkan ID
        $hobby = hobbie::findOrFail($id);

        // Hapus gambar terkait jika ada
        if ($hobby->image) {
            Storage::delete('public/images/' . $hobby->image);
        }

        // Hapus hobby dari database
        $hobby->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('hobbies.main')->with('success', 'Hobby deleted successfully!');
    }
    public function show($id): View
    {
        // Temukan hobby berdasarkan ID
        $hobby = hobbie::findOrFail($id);

        // Mengembalikan tampilan dengan data hobby
        return view('hobbies.show', compact('hobby'));
    }
}