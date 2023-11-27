<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Channel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserPublisherController extends Controller
{
    public function index()
    {
        $publisherRole = \App\Models\Role::where('name', 'publisher')->first();

        if ($publisherRole) {
            $users = User::whereHas('roles', function ($query) use ($publisherRole) {
                $query->where('name', $publisherRole->name);
            })->get();
        } else {
            $users = collect(); // Menggunakan koleksi kosong jika rolenya tidak ditemukan
        }

        return view('pages.user_publisher.index', compact('users'));
    }

    public function create()
    {
        $banks = Bank::all();
        return view('pages.user_publisher.create', compact('banks'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'alamat_ktp' => ['required', 'string', 'max:225'],
            'no_wa' => ['required', 'string', 'max:13', 'min:11'],
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
                'alamat_ktp.required' => 'Kolom alamat wajib diisi.',
                'alamat_ktp.string' => 'Kolom alamat harus menggunakan string.',
                'alamat_ktp.max' => 'Kolom alamat maksimal 225 karakter.',
                'no_wa.required' => 'Kolom nomor telepon wajib diisi.',
                'no_wa.string' => 'Kolom nomor telepon harus menggunakan string.',
                'no_wa.max' => 'Kolom nomor telepon maksimal 13 karakter.',
                'no_wa.min' => 'Kolom nomor telepon minimal 11 karakter.',
            ]);
        $validatedData['password'] = Hash::make($request->password);
        $user = User::create($validatedData);
        $user->assignRole('publisher');
        $user->email_verified_at = now();
        $user->save();
        return redirect()->route('user_publisher.index')->with('success', 'Data user publisher berhasil ditambah.');
    }
    public function edit($id)
    {
        $decryptedId = Crypt::decryptString($id);
        $user = User::findOrFail($decryptedId);
        $channels = Channel::where('user_id', $decryptedId)->get();
        return view('pages.user_publisher.edit', compact('user', 'channels'));

    }
    public function update(Request $request, $id)
    {
        $decryptedId = Crypt::decryptString($id);
        $user = User::findOrFail($decryptedId);
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $decryptedId,
            'password' => 'nullable|min:8|confirmed',
            'alamat_ktp' => 'required|string|max:225',
            'no_wa' => 'required|string|max:13|min:11',
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
                'alamat_ktp.required' => 'Kolom alamat wajib diisi.',
                'alamat_ktp.string' => 'Kolom alamat harus menggunakan string.',
                'alamat_ktp.max' => 'Kolom alamat maksimal 225 karakter.',
                'no_wa.required' => 'Kolom nomor telepon wajib diisi.',
                'no_wa.string' => 'Kolom nomor telepon harus menggunakan string.',
                'no_wa.max' => 'Kolom nomor telepon maksimal 13 karakter.',
                'no_wa.min' => 'Kolom nomor telepon minimal 11 karakter.',
            ]);
        if (!empty($request->password)) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }
        $user->update($validatedData);
        return redirect()->route('user_publisher.index')->with('success', 'Data user publisher berhasil diubah.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->pengajuan()->exists()) {
            return redirect()->route('user_publisher.index')->with('error', 'Data user publisher masih digunakan tidak dapat dihapus.');
        } else {
            $user->delete();
            return redirect()->route('user_publisher.index')->with('success', 'Data user publisher berhasil dihapus.');
        }
    }

}
