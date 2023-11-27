<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimoni = Testimoni::all();
        return view('pages.testimoni.index', compact('testimoni'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('pages.testimoni.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'testimoni' => 'required',
            'user_id' => 'required|exists:users,id',
        ], [
            'testimoni.required' => 'Kolom testimoni wajib diisi.',
            'user_id.required' => 'Kolom member wajib diisi.',
            'user_id.exists' => 'User dengan ID yang dimasukkan tidak ditemukan.',
        ]);        

        $testimoni = new Testimoni;
        $testimoni->testimoni = $request->testimoni;
        $testimoni->user_id = $request->user_id;
        $testimoni->save();
        return redirect()->route('testimoni.index')
            ->with('success', 'Data testimoni berhasil ditambah.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decryptedId = Crypt::decryptString($id);
        $testimoni = Testimoni::findOrFail($decryptedId);
        return view('pages.testimoni.show', compact('testimoni'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decryptedId = Crypt::decryptString($id);
        $testimoni = Testimoni::findOrFail($decryptedId);
        $users = User::all();
        return view('pages.testimoni.edit', compact('testimoni', 'users'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $decryptedId = Crypt::decryptString($id);
        $testimoni = Testimoni::findOrFail($decryptedId);
        $request->validate([
            'testimoni' => 'required',
            'user_id' => 'required|exists:users,id',
        ],[
            'user_id.required' => 'Kolom member wajib diisi.',
            'user_id.exists' => 'User dengan ID yang dimasukkan tidak ditemukan.',
        ]);
        $testimoni->testimoni = $request->testimoni;
        $testimoni->user_id = $request->user_id;
        $testimoni->save();
        return redirect()->route('testimoni.index')
            ->with('success', 'Data testimoni berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $decryptedId = Crypt::decryptString($id);
        $testimoni = Testimoni::findOrFail($decryptedId);
        $testimoni->delete();

        return redirect()->route('testimoni.index')
            ->with('success', 'Data testimoni berhasil dihapus');

    }
}
