<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::all();

        return view('admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        Petugas::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('admin.petugas.index')
                         ->with('success','Petugas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $petugas = Petugas::findOrFail($id);

        return view('admin.petugas.edit', compact('petugas'));
    }

    public function update(Request $request,$id)
    {
        $petugas = Petugas::findOrFail($id);

        $petugas->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'role'=>$request->role
        ]);

        return redirect()->route('admin.petugas.index')
                         ->with('success','Petugas berhasil diupdate');
    }

    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);

        $petugas->delete();

        return redirect()->route('admin.petugas.index')
                         ->with('success','Petugas berhasil dihapus');
    }
}
