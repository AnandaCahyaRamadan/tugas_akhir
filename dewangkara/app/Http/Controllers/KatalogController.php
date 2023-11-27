<?php

namespace App\Http\Controllers;

use App\Exports\KatalogExport;
use App\Http\Controllers\Controller;
use App\Imports\KatalogImport;
use App\Models\Katalog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;

class KatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $katalogs = Katalog::all();
        return view('pages.katalog_lagu.index', compact('katalogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publisher = User::role('publisher')->get();
        return view('pages.katalog_lagu.create', compact('publisher'));

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
            'judul' => ['required', 'string'],
            'pencipta_lagu' => ['required', 'string'],
            'pembawa_lagu' => ['required', 'string'],
            'link_vidio_lagu' => ['nullable', 'string', 'regex:/^(https?:\/\/)?(www\.)?youtube\.com\/watch\?v=[\w-]+/'],
            'publisher_id' => ['required', 'string'],
        ],
            [
                'judul.required' => 'Kolom judul wajib diisi.',
                'judul.string' => 'Kolom judul harus menggunakan string.',
                'pencipta_lagu.required' => 'Kolom pencipta lagu wajib diisi.',
                'pencipta_lagu.string' => 'Kolom pencipta lagu harus menggunakan string.',
                'pembawa_lagu.required' => 'Kolom pembawa lagu wajib diisi.',
                'pembawa_lagu.string' => 'Kolom pembawa lagu harus menggunakan string.',
                'link_vidio_lagu.string' => 'Kolom link video harus menggunakan string.',
                'publisher_id.required' => 'Publisher harus dipilih.',
                'publisher_id.string' => 'Kolom publisher harus menggunakan string.',
                'link_vidio_lagu.regex' => 'Kolom link video harus berupa tautan YouTube yang valid.',
            ]
        );

        Katalog::create($request->all());
        return redirect()->route('katalog.index')->with('success', 'Data katalog berhasil ditambah.');

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
        $katalog = Katalog::findOrFail($decryptedId);
        return view('pages.katalog_lagu.show', compact('katalog'));

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
        $publisher = User::role('publisher')->get();
        $katalog = Katalog::findOrFail($decryptedId);
        return view('pages.katalog_lagu.edit', compact('katalog', 'publisher'));

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
        $request->validate([
            'judul' => ['required', 'string'],
            'pencipta_lagu' => ['required', 'string'],
            'pembawa_lagu' => ['required', 'string'],
            'link_vidio_lagu' => ['nullable', 'string', 'regex:/^(https?:\/\/)?(www\.)?youtube\.com\/watch\?v=[\w-]+/'],
            'publisher_id' => ['required', 'string'],
        ],
            [
                'judul.required' => 'Kolom judul wajib diisi.',
                'judul.string' => 'Kolom judul harus menggunakan string.',
                'pencipta_lagu.required' => 'Kolom pencipta lagu wajib diisi.',
                'pencipta_lagu.string' => 'Kolom pencipta lagu harus menggunakan string.',
                'pembawa_lagu.required' => 'Kolom pembawa lagu wajib diisi.',
                'pembawa_lagu.string' => 'Kolom pembawa lagu harus menggunakan string.',
                'link_vidio_lagu.string' => 'Kolom link video harus menggunakan string.',
                'publisher_id.required' => 'Publisher harus dipilih.',
                'publisher_id.string' => 'Kolom publisher harus menggunakan string.',
                'link_vidio_lagu.regex' => 'Kolom link video harus berupa tautan YouTube yang valid.',
            ]
        );
        $decryptedId = Crypt::decryptString($id);
        $katalog = Katalog::findOrFail($decryptedId);
        $katalog->update($request->all());
        return redirect()->route('katalog.index')->with('success', 'Data katalog berhasil diubah.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $katalog = Katalog::findOrFail($id);
        $katalog->delete();
        return redirect()->route('katalog.index')->with('success', 'Data katalog berhasil dihapus.');
    }

    //import
    public function import(Request $request)
    {
        // Validasi file unggahan
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx|max:2048',
        ]);
        Excel::import(new KatalogImport, request()->file('file'));
        return back();
    }

    //export
    public function export()
    {
        return Excel::download(new KatalogExport, 'katalog_lagu.xlsx');
    }
}
