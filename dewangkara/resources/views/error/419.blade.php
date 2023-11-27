@extends('layouts.app')
@section('title', '419 Page Expired')
@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="misc-wrapper">
      <h2 class="mb-2 mx-2 text-center">Page Expired :(</h2>
      <p class="mb-4 mx-2 text-center">Oops! 😖 Sesi anda habis, silahkan login kembali.</p>
      <div class="mt-3">
        <img
          src="{{ asset ('template/img/expired.png') }}"
          alt="page-misc-error-light"
          width="500"
          class="img-fluid"
          data-app-dark-img="illustrations/page-misc-error-dark.png"
          data-app-light-img="illustrations/page-misc-error-light.png"
        />
      </div>
    </div>
  </div>
</div>
@endsection
