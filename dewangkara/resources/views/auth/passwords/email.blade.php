@extends('layouts.app')
@section('title', 'Lupa Password')
@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Forgot Password -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <img src="{{ asset ('template/img/logo.png') }}" alt="" width="100px">
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Lupa Password? 🔒</h4>
            <p class="mb-4">Masukkan email anda dan kami akan mengirimkan link untuk reset password anda</p>
            <form id="formAuthentication" class="mb-3" action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Email" autofocus/>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
              <button class="btn btn-primary d-grid w-100" type="submit">Kirim link reset password</button>
            </form>
            <div class="text-center">
              <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                Kembali ke halaman login
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
