<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AdminVerification;
use App\Models\Bank;
use App\Models\Channel;
use App\Models\Regency;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        $rules = [
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'regex:/^[0-9]{16}$/', 'unique:users'],
            'kota' => ['required'],
            'alamat_ktp' => ['required', 'string', 'max:225'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'no_wa' => ['required', 'string', 'regex:/^[0-9]+$/', 'min:11', 'max:13'],
            'bank_id' => ['required'],
            'no_rekening' => ['required', 'string', 'max:20', 'unique:users', 'regex:/^[0-9]+$/'],
            'foto_ktp' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048', 'dimensions:ratio=1/1'],
        ];

        $messages = [
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
            'nik.regex' => 'Kolom NIK hanya boleh berisi angka dan harus memiliki panjang tepat 16 karakter.',
            'nik.unique' => 'NIK sudah digunakan.',
            'kota.required' => 'Kolom kota wajib diisi.',
            'alamat_ktp.required' => 'Kolom alamat wajib diisi.',
            'alamat_ktp.string' => 'Kolom alamat harus menggunakan string.',
            'alamat_ktp.max' => 'Kolom alamat maksimal 225 karakter.',
            'no_wa.required' => 'Kolom nomor telepon wajib diisi.',
            'no_wa.string' => 'Kolom nomor telepon harus menggunakan string.',
            'no_wa.max' => 'Kolom nomor telepon maksimal 13 karakter.',
            'no_wa.min' => 'Kolom nomor telepon minimal 11 karakter.',
            'no_wa.regex' => 'Kolom nomor WA hanya boleh berisi karakter angka.',
            'bank_id.required' => 'Kolom bank wajib diisi.',
            'no_rekening.required' => 'Kolom nomor rekening wajib diisi.',
            'no_rekening.string' => 'Kolom nomor rekening harus menggunakan string.',
            'no_rekening.max' => 'Kolom nomor rekening maksimal 20 karakter.',
            'no_rekening.unique' => 'Nomor rekening sudah digunakan.',
            'no_rekening.regex' => 'Kolom nomor rekening hanya boleh berisi karakter angka.',
            'foto_ktp.required' => 'Kolom foto KTP wajib diisi.',
            'foto_ktp.image' => 'Kolom foto KTP harus berupa file gambar.',
            'foto_ktp.mimes' => 'Kolom foto KTP harus berupa file dengan ekstensi: jpeg, png, jpg.',
            'foto_ktp.max' => 'Ukuran foto KTP maksimal 2 MB.',
            'avatar.required' => 'Kolom avatar wajib diisi.',
            'avatar.image' => 'Kolom avatar harus berupa file gambar.',
            'avatar.mimes' => 'Kolom avatar harus berupa file dengan ekstensi: jpeg, png, jpg.',
            'avatar.max' => 'Ukuran avatar maksimal 2 MB.',
            'avatar.dimensions' => 'Ukuran avatar 1 : 1 atau persegi.',
        ];

        return Validator::make($data, $rules, $messages);
    }

    public function showRegistrationForm()
    {
        $banks = Bank::all();
        $kota = Regency::all();
        return view('auth.register', compact('banks', 'kota'));
    }

    protected function create(array $data)
    {
        $ktp = null;
        if (isset($data['foto_ktp'])) {
            $ktp = $data['foto_ktp']->store('ktp');
        }

        $avatar = null;
        if (isset($data['avatar'])) {
            $avatar = $data['avatar']->store('avatar');
        }

        return User::create([
            'nama' => $data['nama'],
            'nik' => $data['nik'],
            'kota' => $data['kota'],
            'alamat_ktp' => $data['alamat_ktp'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'no_wa' => $data['no_wa'],
            'bank_id' => $data['bank_id'],
            'no_rekening' => $data['no_rekening'],
            'foto_ktp' => $ktp,
            'avatar' => $avatar,
        ]);
    }

    public function register(Request $request)
    {
        $regex = '/^(https:\/\/www\.youtube\.com\/channel\/[A-Za-z0-9_-]+|https:\/\/www\.youtube\.com\/@([A-Za-z0-9_-]+))$/';
        $this->validator($request->all())->validate();
        
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
    
        $user = $this->create($request->all());
        $user->assignRole('cover-patner');
    
        if ($user->save()) {
            foreach ($validChannels as $channel) {
                Channel::create([
                    'user_id' => $user->id,
                    'link_channel' => $channel['link_channel'],
                    'nama_channel' => $channel['nama_channel'], // Save the channel name
                ]);
            }
            
            
            $this->guard()->login($user);
    
            $admin = User::Role('super-admin')->first();
            Mail::to($admin->email)->send(new AdminVerification($user));
    
            return redirect('/dashboard');
        } else {
            return redirect()->back()->with('error', 'Registrasi gagal. Silakan coba lagi.')->withInput();
        }
    }
    

}
