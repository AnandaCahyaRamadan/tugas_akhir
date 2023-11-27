<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\UserVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class VerifikasiEmailController extends Controller
{
    public function update(Request $request, $id) {
        $decryptedId = Crypt::decryptString($id);
        $user = User::find($decryptedId);
        $user->email_verified_at = now();
        $user->save();
        Mail::to($user->email)->send(new UserVerification());
        return view('pages.verifikasi.index');
    }
}
