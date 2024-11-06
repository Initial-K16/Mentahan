<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MuridController extends Controller
{
    // Menampilkan data murid
    public function index()
    {
        $murids = User::where('role', 'murid')->get();
        return view('admin.murid.index', compact('murids'));
    }

    // Menampilkan form untuk tambah murid
    public function create()
    {
        return view('admin.murid.create');
    }

    // Menyimpan murid baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'murid',
        ]);

        return redirect()->route('murid.index')->with('success', 'Murid berhasil ditambahkan.');
    }

    // Menampilkan form untuk edit murid
    public function edit($id)
    {
        $murid = User::findOrFail($id);
        return view('admin.murid.edit', compact('murid'));
    }

    // Mengupdate data murid
    public function update(Request $request, $id)
    {
        $murid = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $murid->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $murid->password,
        ]);

        return redirect()->route('murid.index')->with('success', 'Data murid berhasil diupdate.');
    }

    // Menghapus data murid
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('murid.index')->with('success', 'Murid berhasil dihapus.');
    }
}