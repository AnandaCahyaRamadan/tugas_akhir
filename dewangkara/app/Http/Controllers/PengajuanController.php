<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\AdminVerificationCover;
use App\Mail\AdminVerificationKonten;
use App\Mail\UserVerificationCover;
use App\Mail\UserVerificationKonten;
use App\Models\Channel;
use App\Models\Katalog;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCover()
    {
        if (Auth::user()->hasRole('super-admin')) {
            $pengajuan = Pengajuan::all();
            return view('pages.pengajuan-cover.index', compact('pengajuan'));
        }
        if (Auth::user()->hasRole('cover-patner')) {
            $pengajuan = Pengajuan::where('created_by', Auth::user()->id)->get();
            return view('pages.pengajuan-cover.index', compact('pengajuan'));
        }
        if (Auth::user()->hasRole('publisher')) {
            $publisherId = Auth::user()->id;
            $pengajuan = Pengajuan::whereHas('katalog', function ($query) use ($publisherId) {
                $query->where('publisher_id', $publisherId);
            })->get();
            return view('pages.pengajuan-cover.index', compact('pengajuan'));
        }
    }

    public function getLinkChannel(Request $request)
    {
        $namaChannel = $request->input('nama_channel');
        $channel = Channel::where('nama_channel', $namaChannel)->get();
        return response()->json($channel);
    }

    // public function indexKonten()
    // {
    //     if (Auth::user()->hasRole('super-admin')) {
    //         $pengajuan = Pengajuan::whereNotNull('is_active')->get();
    //         return view('pages.pengajuan-konten.index', compact('pengajuan'));
    //     }
    //     if (Auth::user()->hasRole('cover-patner')) {
    //         $pengajuan = Pengajuan::where('created_by', Auth::user()->id)
    //             ->whereNotNull('is_active')
    //             ->get();
    //         return view('pages.pengajuan-konten.index', compact('pengajuan'));
    //     }
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCover($id)
    {
        $decryptedId = Crypt::decryptString($id);
        $katalog = Katalog::where('id', $decryptedId)->first();
        $users = User::role('cover-patner')->get();
        if (Auth::user()->hasRole('cover-patner')) {
            $channel = Channel::where('user_id', Auth::user()->id)->get();
            return view('pages.pengajuan-cover.create', compact('katalog', 'users', 'channel'));
        }
        $channel = Channel::all();
        return view('pages.pengajuan-cover.create', compact('katalog', 'users', 'channel'));
    }

    // public function createKonten()
    // {
    //     $pengajuan = Pengajuan::where('created_by', Auth::user()->id)
    //         ->where('status', 'accepted')
    //         ->whereNull('is_active')
    //         ->get();
    //     return view('pages.pengajuan-konten.create', compact('pengajuan'));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCover(Request $request)
    {
        if (Auth::user()->hasRole('super-admin')) {
            $request->validate([
                'judul' => ['required', 'string'],
                'nama_channel' => ['required'],
                'link_channel' => ['required', 'string', 'regex:/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/'],
                'created_by' => ['required'],
            ],
                [
                    'judul.required' => 'Kolom judul wajib diisi.',
                    'judul.string' => 'Kolom judul harus menggunakan string.',
                    'link_channel.required' => 'Kolom link channel wajib diisi.',
                    'nama_channel.required' => 'Kolom nama channel wajib diisi.',
                    'link_channel.string' => 'Kolom link channel harus menggunakan string.',
                    'link_channel.regex' => 'Link channel tidak sesuai.',
                    'created_by.required' => 'Kolom pengcover wajib diisi.',
                ]
            );
        } else {
            $request->validate([
                'judul' => ['required', 'string'],
                'link_channel' => ['required', 'string', 'regex:/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/'],
            ],
                [
                    'judul.required' => 'Kolom judul wajib diisi.',
                    'judul.string' => 'Kolom judul harus menggunakan string.',
                    'link_channel.required' => 'Kolom link channel wajib diisi.',
                    'link_channel.string' => 'Kolom link channel harus menggunakan string.',
                    'link_channel.regex' => 'Link channel tidak sesuai.',
                ]
            );

        }

        $pengajuan = new Pengajuan;
        $pengajuan->katalog_id = $request->id;
        $pengajuan->nama_channel = $request->nama_channel;
        $pengajuan->link_channel = $request->link_channel;
        $pengajuan->status = 'pending';
        if (Auth::user()->hasRole('super-admin')) {
            $pengajuan->created_by = $request->created_by;
        } else {
            $pengajuan->created_by = Auth::user()->id;
        }
        $pengajuan->save();
        $admin = User::Role('super-admin')->first();
        Mail::to($pengajuan->katalog->User->email)->send(new AdminVerificationCover($pengajuan));
        return redirect()->route('pengajuan-cover.index')->with('success', 'Pengajuan berhasil dan masih ditinjau.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCover($id)
    {
        $decryptedId = Crypt::decryptString($id);
        $pengajuan = Pengajuan::findOrFail($decryptedId);
        return view('pages.pengajuan-cover.show', compact('pengajuan'));

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCover($id)
    {
        //
    }

    // public function updateJudulLagu(Request $request, $id)
    // {
    //     $request->validate(
    //         [
    //             'judul_lagu' => ['required', 'string'],
    //             'nama_artis' => ['required', 'string'],
    //         ],
    //         [
    //             'judul_lagu.required' => 'Kolom judul lagu diisi.',
    //             'judul_lagu.string' => 'Kolom judul lagu harus menggunakan string.',
    //             'nama_artis.required' => 'Kolom nama artis wajib diisi.',
    //             'nama_artis.string' => 'Kolom nama artis harus menggunakan string.',
    //         ]
    //     );
    //     $pengajuan = Pengajuan::findOrFail($id);
    //     $pengajuan->judul_lagu = $request->judul_lagu;
    //     $pengajuan->nama_artis = $request->nama_artis;
    //     if ($pengajuan->judul_lagu && $pengajuan->nama_artis && $pengajuan->art_track && $pengajuan->audio) {
    //         $pengajuan->is_active = 'pending';
    //         Mail::to($pengajuan->katalog->User->email)->send(new AdminVerificationKonten($pengajuan));
    //     }
    //     $pengajuan->save();

    //     return redirect()->back()->with('success', 'Judul lagu dan nama performer telah ditambahkan');
    // }

    // public function updatePerformer(Request $request, $id)
    // {
    //     $request->validate(
    //         [
    //             'nama_artis' => ['required', 'string'],
    //         ],
    //         [
    //             'nama_artis.required' => 'Kolom nama artis wajib diisi.',
    //             'nama_artis.string' => 'Kolom nama artis harus menggunakan string.',
    //         ]
    //     );

    //     $pengajuan = Pengajuan::findOrFail($id);
    //     $pengajuan->nama_artis = $request->nama_artis;
    //     if ($pengajuan->judul_lagu && $pengajuan->nama_artis && $pengajuan->art_track && $pengajuan->audio) {
    //         $pengajuan->is_active = 'pending';
    //         Mail::to($pengajuan->katalog->User->email)->send(new AdminVerificationKonten($pengajuan));
    //     }
    //     $pengajuan->save();
    //     return redirect()->back()->with('success', 'Nama Performer telah ditambahkan');
    // }

    public function updateAudio(Request $request, $id)
    {
        $request->validate([
            'audio' => ['required', 'mimes:wav'],
        ], [
            'audio.required' => 'Kolom jenis audio wajib diisi.',
            'audio.mimes' => 'File audio harus dalam format WAV.',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        // Simpan file audio
        if ($request->hasFile('audio')) {
            $pengajuan->audio = $request->file("audio")->store("audio");
        }
        if ($pengajuan->art_track && $pengajuan->audio) {
            $pengajuan->is_active = 'pending';
            Mail::to($pengajuan->katalog->User->email)->send(new AdminVerificationKonten($pengajuan));
        }
        $pengajuan->save();

        return redirect()->back()->with('success', 'Audio telah ditambahkan');
    }

    public function updateThumbnail(Request $request, $id)
    {
        $request->validate([
            'art_track' => [
                'required',
                'image', // Memastikan file adalah gambar
                'dimensions:min_width=2000,min_height=2000,max_width=2000,max_height=2000', // Memastikan ukuran gambar
                'mimes:jpeg', // Memastikan format file adalah JPEG
            ],
        ], [
            'art_track.required' => 'Kolom art work wajib diisi.',
            'art_track.image' => 'File harus dalam format gambar/JPEG.',
            'art_track.dimensions' => 'Gambar harus berukuran 2000x2000 piksel.',
            'art_track.mimes' => 'File gambar harus dalam format JPEG.',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);

        // Simpan file gambar (thumbnail)
        if ($request->hasFile('art_track')) {
            $pengajuan->art_track = $request->file("art_track")->store("art_track");
        }
        if ($pengajuan->art_track && $pengajuan->audio) {
            $pengajuan->is_active = 'pending';
            Mail::to($pengajuan->katalog->User->email)->send(new AdminVerificationKonten($pengajuan));
        }
        $pengajuan->save();

        return redirect()->back()->with('success', 'Art work telah ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAcceptedCover(Request $request, $id)
    {
        $decryptedId = Crypt::decryptString($id);
        $pengajuan = Pengajuan::findOrFail($decryptedId);
        $pengajuan->status = 'accepted';
        $pengajuan->save();
        Mail::to($pengajuan->user->email)->send(new UserVerificationCover($pengajuan));
        return redirect()->back()->with('success', 'Pengajuan Diterima.');
    }
    public function updateRejectedCover(Request $request, $id)
    {
        $decryptedId = Crypt::decryptString($id);
        $pengajuan = Pengajuan::findOrFail($decryptedId);
        $pengajuan->status = 'rejected';
        $pengajuan->save();
        Mail::to($pengajuan->user->email)->send(new UserVerificationCover($pengajuan));
        return redirect()->back()->with('success', 'Pengajuan Ditolak.');
    }

    public function updateAcceptedKonten(Request $request, $id)
    {
        $decryptedId = Crypt::decryptString($id);
        $pengajuan = Pengajuan::findOrFail($decryptedId);
        $pengajuan->is_active = 'accepted';
        $pengajuan->save();
        Mail::to($pengajuan->user->email)->send(new UserVerificationKonten($pengajuan));
        return redirect()->back()->with('success', 'Pengajuan Diterima.');
    }
    public function updateRejectedKonten(Request $request, $id)
    {
        $decryptedId = Crypt::decryptString($id);
        $pengajuan = Pengajuan::findOrFail($decryptedId);
        $pengajuan->is_active = 'rejected';
        if ($pengajuan->audio) {
            Storage::delete($pengajuan->audio);
            $pengajuan->audio = null;
        }
        if ($pengajuan->art_track) {
            Storage::delete($pengajuan->art_track);
            $pengajuan->art_track = null;
        }
        $pengajuan->keterangan = $request->keterangan;
        $pengajuan->save();
        Mail::to($pengajuan->user->email)->send(new UserVerificationKonten($pengajuan));
        return redirect()->back()->with('success', 'Pengajuan Ditolak.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCover($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        if ($pengajuan->is_active == null) {
            if ($pengajuan->audio) {
                Storage::delete($pengajuan->audio);
            }
            if ($pengajuan->art_track) {
                Storage::delete($pengajuan->art_track);
            }
            $pengajuan->delete();
            return redirect()->route('pengajuan-cover.index')->with('success', 'Pengajuan berhasil dihapus.');
        }
        return redirect()->route('pengajuan-cover.index')->with('error', 'Pengajuan tidak dapat dihapus karena masih digunakan.');
    }

    public function destroyKonten($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        if ($pengajuan->audio) {
            Storage::delete($pengajuan->audio);
        }
        $pengajuan->audio = null;
        $pengajuan->save();
        return redirect()->back()->with('success', 'Konten berhasil dihapus.');
    }
}
