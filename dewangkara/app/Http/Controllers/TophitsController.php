<?php

namespace App\Http\Controllers;

use App\Models\Tophits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class TophitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tophits = Tophits::all();
        return view('pages.tophits.index', compact('tophits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tophits = Tophits::all();
        return view('pages.tophits.create', compact('tophits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'link' => [
                    'required',
                    'string',
                    'regex:/^(https?:\/\/)?(www\.)?youtube\.com\/embed\/[\w-]+/'
                ],
                
            ],
            [
                'link.required' => 'Kolom link vidio wajib di isi',
                'link.regex' => 'Kolom link video harus berupa tautan YouTube yang valid.',
            ]
        );
        Tophits::create($request->all());
        return redirect()->route('tophits.index')
            ->with('success', 'Data top hits berhasil ditambah.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decrypt = Crypt::decryptString($id);
        $tophits = Tophits::find($decrypt);
        return view('pages.tophits.show', compact('tophits'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypt = Crypt::decryptString($id);
        $tophits = Tophits::find($decrypt);
        return view('pages.tophits.edit', compact('tophits'));
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
        $tophits = Tophits::findOrFail($decryptedId);
        $validated = $request->validate(
            [
                'link' => [
                    'required',
                    'string',
                    'regex:/^(https?:\/\/)?(www\.)?youtube\.com\/embed\/[\w-]+/'
                ],
                
            ],
            [
                'link.required' => 'Kolom link vidio wajib di isi',
                'link.regex' => 'Kolom link video harus berupa tautan YouTube yang valid.',
            ]);

        $tophits->update($validated);
        return redirect()->route('tophits.index')
            ->with('success', 'Data top hits berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $decrypt = Crypt::decryptString($id);
        $tophits = Tophits::find($decrypt);
        $tophits->delete();
        return redirect()->route('tophits.index')->with('success', 'Data top hits berhasil dihapus');
    }
}
