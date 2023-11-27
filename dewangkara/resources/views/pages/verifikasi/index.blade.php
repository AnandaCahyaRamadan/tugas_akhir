{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


@extends('layouts.app')
@section('title', 'Verifikasi Email')
@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Forgot Password -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-text demo text-body fw-bolder">Dps</span>
              </a>
            </div>
            <div class="d-flex justify-content-center pb-4">
                <img class="bounce-in" src="https://i.postimg.cc/65GkYhBs/verify.png" alt="" width="100px">
            </div>
            <span>Akun user berhasil di verifikasi</span>
            <a href="{{ route('login') }}">Tinggalkan Halaman ini</a>
          </div>
        </div>
      </div>
    </div>
  </div>

<style>
    .bounce-in {
        animation: bounce-in 2s ease infinite;
    }
    @keyframes bounce-in {
    0% {
        opacity: 0;
        transform: scale(.3);
    }
    50% {
        opacity: 1;
        transform: scale(1.05);
    }
    70% { transform: scale(.9); }
    100% { transform: scale(1); }
    }
</style>
@endsection
