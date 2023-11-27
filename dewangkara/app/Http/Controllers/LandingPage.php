<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Katalog;
use App\Models\Pengajuan;
use App\Models\Role;
use App\Models\Testimoni;
use App\Models\Tophits;
use App\Models\User;
use Illuminate\Http\Request;

class LandingPage extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($publisherRole = Role::where('name', 'publisher')->first()) {
            $publisher = $users = User::whereHas('roles', function ($query) use ($publisherRole) {
                $query->where('name', $publisherRole->name);
            })->count();
        }
        else {
            $publisher = 0 ;
        }
        $katalog = Katalog::count();
        $katalog_lisensi = Pengajuan::where('is_active', 'accepted')->distinct('katalog_id')->count();
        $tophits = Tophits::all();
        $testimoni = Testimoni::all();
        $user = User::whereNotNull('email_verified_at');
        $cover = $user->Role('cover-patner')->take(6)->get();
        return view('pages.landingpage', compact('publisher','cover' , 'katalog', 'katalog_lisensi', 'tophits', 'testimoni'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function member()
    {
        $user = User::whereNotNull('email_verified_at');
        $users = $user->Role('cover-patner')->get();
        return view('pages.member', compact('users'));
    }
    
    public function tentang(){
        return view('pages.tentang');
    }

    public function hubungiKami() {
        return view('pages.hubungi-kami');
    }

    public function katalog() {
        $katalog = Katalog::all();
        return view('pages.katalog', compact('katalog'));
    }
}
