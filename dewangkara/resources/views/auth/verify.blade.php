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
              <img src="{{ asset ('template/img/logo.png') }}" alt="" width="100px">
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Verifikasi Email</h4>
            <div class="pb-2 pt-2">
              <p>{{ Auth::user()->email }}</p>
            </div>
            <div class="d-flex justify-content-center pb-4 pt-2" >
              <img class="rotate" src="https://i.postimg.cc/hPKSfJv8/wait.png" alt="" width="100px">
            </div>
            <span class="text-primary">Pastikan email anda benar</span>
            <p class="mb-2">Tunggu admin memverifikasi pendaftaran anda</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- <style>
    .rotate{
    width:80px;
    height:80px;
    animation: rotation infinite 3s linear;
    }

    @keyframes rotation{
    from{
        transform:rotate(0deg);
    }

    to{
        transform:rotate(360deg);
    }
    }
  </style> --}}
@endsection
