<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\UserVerification;
use App\Models\Bank;
use App\Models\Channel;
use App\Models\Regency;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserCoverPatnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $coverPatner = Role::where('name', 'cover-patner')->first();

        if ($coverPatner) {
            $users = User::whereHas('roles', function ($query) use ($coverPatner) {
                $query->where('name', $coverPatner->name);
            })->get();
        } else {
            $users = collect(); // Menggunakan koleksi kosong jika rolenya tidak ditemukan
        }
        // dd($users);

        return view('pages.user_cover_patner.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::all();
        $kota = Regency::all();
        return view('pages.user_cover_patner.create', compact('banks', 'kota'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->nama);
        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nik' => ['required', 'string', 'max:16', 'unique:users'],
            'kota' => ['required', 'string', 'max:225'],
            'alamat_ktp' => ['required'],
            'no_wa' => ['required', 'string', 'max:13', 'min:11'],
            'bank_id' => ['required'],
            'no_rekening' => ['required', 'string', 'max:20', 'unique:users'],
            'foto_ktp' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048', 'dimensions:ratio=1/1'],
        ],
            [
                'nama.required' => 'Kolom nama wajib diisi.',
                'nama.string' => 'Kolom nama harus menggunakan string.',
                'nama.max' => 'Kolom nama maksimal 255 karakter.',
                'email.required' => 'Kolom email wajib diisi.',
                'email.string' => 'Kolom email harus menggunakan string.',
                'email.email' => 'Format email tidak valid.',
                'email.max' => 'Kolom email maksimal 255 karakter.',
                'email.unique' => 'Email sudah digunakan.',
                'password.required' => 'Kolom password wajib diisi.',
                'password.string' => 'Kolom password harus menggunakan string.',
                'password.min' => 'Password minimal harus memiliki :min karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
                'nik.required' => 'Kolom NIK wajib diisi.',
                'nik.string' => 'Kolom NIK harus menggunakan string.',
                'nik.max' => 'Kolom NIK maksimal 16 karakter.',
                'nik.unique' => 'NIK sudah digunakan.',
                'kota.required' => 'Kolom kota wajib diisi.',
                'alamat_ktp.required' => 'Kolom alamat wajib diisi.',
                'alamat_ktp.string' => 'Kolom alamat harus menggunakan string.',
                'alamat_ktp.max' => 'Kolom alamat maksimal 225 karakter.',
                'no_wa.required' => 'Kolom nomor telepon wajib diisi.',
                'no_wa.string' => 'Kolom nomor telepon harus menggunakan string.',
                'no_wa.max' => 'Kolom nomor telepon maksimal 13 karakter.',
                'no_wa.min' => 'Kolom nomor telepon minimal 11 karakter.',
                'bank_id.required' => 'Kolom bank wajib diisi.',
                'no_rekening.required' => 'Kolom nomor rekening wajib diisi.',
                'no_rekening.string' => 'Kolom nomor rekening harus menggunakan string.',
                'no_rekening.max' => 'Kolom nomor rekening maksimal 20 karakter.',
                'no_rekening.unique' => 'Nomor rekening sudah digunakan.',
                'foto_ktp.required' => 'Kolom foto KTP wajib diisi.',
                'foto_ktp.image' => 'Kolom foto KTP harus berupa file gambar.',
                'foto_ktp.mimes' => 'Kolom foto KTP harus berupa file dengan ekstensi: jpeg, png, jpg.',
                'foto_ktp.max' => 'Ukuran foto KTP maksimal 2 MB.',
                'avatar.image' => 'Kolom foto KTP harus berupa file gambar.',
                'avatar.mimes' => 'Kolom foto KTP harus berupa file dengan ekstensi: jpeg, png, jpg.',
                'avatar.max' => 'Ukuran foto KTP maksimal 2 MB.',
                'avatar.dimensions' => 'Ukuran avatar 1 : 1 atau persegi.',
            ]);

        if ($request->file('foto_ktp')) {
            $validatedData['foto_ktp'] = $request->file('foto_ktp')->store('ktp');
        }
        if ($request->file('avatar')) {
            $validatedData['avatar'] = $request->file('avatar')->store('avatar');
        }
        $validatedData['password'] = Hash::make($request->password);
        $regex = '/^(https:\/\/www\.youtube\.com\/channel\/[A-Za-z0-9_-]+|https:\/\/www\.youtube\.com\/@([A-Za-z0-9_-]+))$/';
        $validChannels = [];
        $namaChannels = $request->nama_channel;

        foreach ($request->channel as $key => $link_channel) {
            if (!empty($link_channel)) {
                if (preg_match($regex, $link_channel)) {
                    $validChannels[] = [
                        'nama_channel' => $namaChannels[$key],
                        'link_channel' => $link_channel,
                    ];
                } else {
                    return redirect()->back()->with('error', 'Pastikan link channel YouTube benar')->withInput();
                }
            } else {
                return redirect()->back()->with('error', 'Pastikan link channel dan nama YouTube tidak kosong')->withInput();
            }
        }

        if (empty($validChannels)) {
            return redirect()->back()->with('error', 'Setidaknya satu YouTube diperlukan')->withInput();
        }

        $user = User::create($validatedData);
        $user->assignRole('cover-patner');
        $user->email_verified_at = now();
        $user->save();
        // Save user only if roles are assigned successfully
        if ($user->save()) {
            foreach ($validChannels as $channel) {
                Channel::create([
                    'user_id' => $user->id,
                    'link_channel' => $channel['link_channel'],
                    'nama_channel' => $channel['nama_channel'], // Save the channel name
                ]);
            }
            return redirect()->route('user_cover_patner.index')->with('success', 'Data user cover patner berhasil ditambah.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function verifikasi($id)
    {
        $decryptedId = Crypt::decryptString($id);
        $user = User::findOrFail($decryptedId);
        $user->email_verified_at = now();
        $user->save();
        Mail::to($user->email)->send(new UserVerification());
        return redirect()->route('user_cover_patner.index')->with('success', 'Verifikasi berhasil.');
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
        $kota = Regency::all();
        $bank = Bank::all();
        $user = User::findOrFail($decryptedId);
        $channels = Channel::where('user_id', $decryptedId)->get();
        return view('pages.user_cover_patner.edit', compact('user', 'bank', 'channels', 'kota'));

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
        $user = User::findOrFail($decryptedId);
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $decryptedId,
            'password' => 'nullable|min:8|confirmed',
            'nik' => 'required|string|max:16|unique:users,nik,' . $decryptedId,
            'kota' => 'required',
            'alamat_ktp' => 'required|string|max:225',
            'no_wa' => 'required|string|max:13|min:11',
            'bank_id' => 'required',
            'no_rekening' => 'required|string|max:20|unique:users,no_rekening,' . $decryptedId,
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:ratio=1/1',
        ],
            [
                'nama.required' => 'Kolom nama wajib diisi.',
                'nama.string' => 'Kolom nama harus menggunakan string.',
                'nama.max' => 'Kolom nama maksimal 255 karakter.',
                'email.required' => 'Kolom email wajib diisi.',
                'email.string' => 'Kolom email harus menggunakan string.',
                'email.email' => 'Format email tidak valid.',
                'email.max' => 'Kolom email maksimal 255 karakter.',
                'email.unique' => 'Email sudah digunakan.',
                'password.min' => 'Password minimal harus memiliki :min karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
                'nik.required' => 'Kolom NIK wajib diisi.',
                'nik.string' => 'Kolom NIK harus menggunakan string.',
                'nik.max' => 'Kolom NIK maksimal 16 karakter.',
                'nik.unique' => 'NIK sudah digunakan.',
                'kota.required' => 'Kolom kota wajib diisi.',
                'alamat_ktp.required' => 'Kolom alamat wajib diisi.',
                'alamat_ktp.string' => 'Kolom alamat harus menggunakan string.',
                'alamat_ktp.max' => 'Kolom alamat maksimal 225 karakter.',
                'no_wa.required' => 'Kolom nomor telepon wajib diisi.',
                'no_wa.string' => 'Kolom nomor telepon harus menggunakan string.',
                'no_wa.max' => 'Kolom nomor telepon maksimal 13 karakter.',
                'no_wa.min' => 'Kolom nomor telepon minimal 11 karakter.',
                'bank_id.required' => 'Kolom bank wajib diisi.',
                'no_rekening.required' => 'Kolom nomor rekening wajib diisi.',
                'no_rekening.string' => 'Kolom nomor rekening harus menggunakan string.',
                'no_rekening.max' => 'Kolom nomor rekening maksimal 20 karakter.',
                'no_rekening.unique' => 'Nomor rekening sudah digunakan.',
                'foto_ktp.image' => 'Kolom avatar harus berupa file gambar.',
                'foto_ktp.mimes' => 'Kolom avatar harus berupa file dengan ekstensi: jpeg, png, jpg.',
                'foto_ktp.max' => 'Ukuran avatar maksimal 2 MB.',
                'avatar.image' => 'Kolom avatar harus berupa file gambar.',
                'avatar.mimes' => 'Kolom avatar harus berupa file dengan ekstensi: jpeg, png, jpg.',
                'avatar.max' => 'Ukuran avatar maksimal 2 MB.',
                'avatar.dimensions' => 'Ukuran avatar 1 : 1 atau persegi.',
            ]);

        if ($request->hasFile('foto_ktp')) {
            if ($user->foto_ktp) {
                Storage::delete($user->foto_ktp);
            }
            $validatedData['foto_ktp'] = $request->file('foto_ktp')->store('ktp');
        }
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }
            $validatedData['avatar'] = $request->file('avatar')->store('avatar');
        }

        if (!empty($request->password)) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }
        $regex = '/^(https:\/\/www\.youtube\.com\/channel\/[A-Za-z0-9_-]+|https:\/\/www\.youtube\.com\/@([A-Za-z0-9_-]+))$/';
        $channels = Channel::where('user_id', $user->id);
        if ($request->channel[0] != null) {
        $validChannels = [];
        $namaChannels = $request->nama_channel;

        foreach ($request->channel as $key => $link_channel) {
            if (!empty($link_channel)) {
                if (preg_match($regex, $link_channel)) {
                    $validChannels[] = [
                        'nama_channel' => $namaChannels[$key],
                        'link_channel' => $link_channel,
                    ];
                } else {
                    return redirect()->back()->with('error', 'Pastikan link channel YouTube benar')->withInput();
                }
            } else {
                return redirect()->back()->with('error', 'Pastikan link channel dan nama YouTube tidak kosong')->withInput();
            }
            }

            if (empty($validChannels)) {
                return redirect()->back()->with('error', 'Setidaknya satu YouTube diperlukan')->withInput();
            }
            $channels->delete();
            if ($user->save()) {
                foreach ($validChannels as $channel) {
                    Channel::create([
                        'user_id' => $user->id,
                        'link_channel' => $channel['link_channel'],
                        'nama_channel' => $channel['nama_channel'], // Save the channel name
                    ]);
                }
                $user->update($validatedData);
                return redirect()->route('user_cover_patner.index')->with('success', 'Data user cover patner berhasil diubah.');
            }
        } else {
            return redirect()->back()->with('error', 'Pastikan channel youtube tidak kosong')->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        // Periksa apakah ada relasi antara user dan link channel
        $user = User::findOrFail($id);
        // if ($user->Channels()->exists()) {
        //     return redirect()->route('user_cover_patner.index')->with('error', 'Data user terhubung dengan link channel. Hapus relasi tersebut sebelum menghapus data.');
        // }

        if ($user->pengajuan()->exists()) {
            return redirect()->route('user_cover_patner.index')->with('error', 'Data user cover masih digunakan tidak dapat dihapus.');
        } else {
            if ($user->foto_ktp) {
                Storage::delete($user->foto_ktp);
            }
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }
            $user->delete();
            return redirect()->route('user_cover_patner.index')->with('success', 'Data user cover patner berhasil dihapus.');
        }
    }
}
