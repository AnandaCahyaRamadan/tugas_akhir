<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Channel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $decryptedId = Crypt::decryptString($id);
        $bank = Bank::all();
        $user = User::findOrFail($decryptedId);
        $channels = Channel::where('user_id', $decryptedId)->get();
        return view('pages.profile.edit', compact('user', 'bank', 'channels'));
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
        // dd($decryptedId);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $decryptedId,
            'password' => 'nullable|min:8|confirmed',
            'nik' => 'nullable|string|max:16|unique:users,nik,' . $decryptedId,
            'alamat_ktp' => 'required|string|max:225',
            'no_wa' => 'required|string|max:13|min:11',
            'bank_id' => 'nullable',
            'no_rekening' => 'nullable|string|max:20|unique:users,no_rekening,' . $decryptedId,
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

        ],
            [
                'nama.required' => 'Kolom nama wajib di isi',
                'nama.string' => 'Kolom nama harus menggunakan string.',
                'nama.max' => 'Kolom nama maksimal 255 karakter.',
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
                'alamat_ktp.required' => 'Kolom alamat wajib diisi.',
                'alamat_ktp.string' => 'Kolom alamat harus menggunakan string.',
                'alamat_ktp.max' => 'Kolom alamat maksimal 225 karakter.',
                'no_wa.required' => 'Kolom nomor telepon wajib diisi.',
                'no_wa.string' => 'Kolom nomor telepon harus menggunakan string.',
                'no_wa.max' => 'Kolom nomor telepon maksimal 13 karakter.',
                'no_wa.min' => 'Kolom nomor telepon minimal 11 karakter.',
                'bank_id.required' => 'Kolom bank wajib diisi.',
                'no_rekening.string' => 'Kolom nomor rekening harus menggunakan string.',
                'no_rekening.max' => 'Kolom nomor rekening maksimal 20 karakter.',
                'no_rekening.unique' => 'Nomor rekening sudah digunakan.',
                'foto_ktp.image' => 'Kolom foto KTP harus berupa file gambar.',
                'foto_ktp.mimes' => 'Kolom foto KTP harus berupa file dengan ekstensi: jpeg, png, jpg.',
                'foto_ktp.max' => 'Ukuran foto KTP maksimal 2 MB.',
                'avatar.image' => 'Kolom avatar harus berupa file gambar.',
                'avatar.mimes' => 'Kolom avatar harus berupa file dengan ekstensi: jpeg, png, jpg.',
                'avatar.max' => 'Ukuran avatar maksimal 2 MB.',
            ]);

        $user = User::findOrFail($decryptedId);

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
        if (Auth::user()->hasRole('cover-patner')) {
            $channels = Channel::where('user_id', $user->id);
            if ($request->channel) {
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
                    // dd($user);
                    return redirect()->route('profile.edit', $id)->with('success', 'Data profile berhasil diubah.');
                }
            } else {
                return redirect()->back()->with('error', 'Pastikan channel youtube tidak kosong')->withInput();
            }
        }
        if (Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('publisher')) {
            $user->update($validatedData);
            return redirect()->route('profile.edit', $id)->with('success', 'Data profil berhasil diubah.');
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
        //
    }

    public function uploadCropImage(Request $request)
    {
        $data = $request->input('image');
        list($type, $data) = explode(';', $data);
        list(, $data) = explode(',', $data);
        $image = base64_decode($data);

        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Membuat nama unik untuk gambar dengan menggunakan ID pengguna
        $imageName = $user->id . '_' . time() . '.png';

        // Menyimpan gambar yang di-crop ke direktori 'public/avatar/'
        $path = 'avatar/' . $imageName;

        // Hapus gambar avatar lama jika ada
        if ($user->avatar) {
            Storage::delete($user->avatar);
        }

        Storage::put($path, $image);

        // Simpan nama file avatar ke kolom 'avatar' pada model User
        $user->avatar = $path;
        $user->save();

        return response()->json(['status' => true, 'msg' => 'Ukuran avatar maksimal 2 MB.']);
    }

}
