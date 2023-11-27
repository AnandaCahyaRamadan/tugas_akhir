@extends('layouts.landingpage')

@section('title', 'Hubungi Kami | Dewangkara')

@section('content')
<main>
    <section class="overflow-hidden pt-2 pt-md-4 pt-lg-5">
        <div class="container pt-1 pt-sm-0">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3">
                    <li class="breadcrumb-item">
                        <a href=""><i class="bx bx-home-alt fs-lg me-1"></i>Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Hubungi Kami</li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="container py-2 py-lg-4 mb-2 mb-md-3">
        <div class="row">
            <div class="col-lg-6 mb-5">
                <h2 class="h4 mb-4">CV. Dewangkara Pujangga Sejahtera</h2>
                <ul class="list-unstyled pb-2 pb-lg-0 mb-4 mb-lg-5">
                    <li class="d-flex pb-1 mb-2">
                        <i class="bx bx-map text-primary fs-xl me-2" style="margin-top: .125rem;"></i>
                        Bening Residence C7, Genteng - Banyuwangi, <br>Jawa Timur, Indonesia 68465
                    </li>
                    <li class="d-flex pb-1 mb-2">
                        <i class="bx bx-envelope text-primary fs-xl me-2" style="margin-top: .125rem;"></i>
                        <a href="mailto:info@dewangkara.com" target="_blank">info@dewangkara.com</a>
                    </li>
                    <li class="d-flex pb-1 mb-2">
                        <i class="bx bx-phone-call text-primary fs-xl me-2" style="margin-top: .125rem;"></i>
                        <a href="tel:+6285336448009" target="_blank">085 336 448 009</a>
                    </li>
                    <li class="d-flex">
                        <i class="bx bx-time-five text-primary fs-xl me-2" style="margin-top: .125rem;"></i>
                        <div>
                            <strong class="text-nav">Senin - Sabtu</strong>: 08:00 - 16:00
                        </div>
                    </li>
                </ul>

                <div class="d-flex pt-1 pt-md-3 pt-xl-4">
                    <a href="#" target="_blank" class="btn btn-icon btn-secondary btn-facebook me-3">
                        <i class="bx bxl-facebook"></i>
                    </a>
                    <a href="#" target="_blank" class="btn btn-icon btn-secondary btn-youtube me-3">
                        <i class="bx bxl-instagram"></i>
                    </a>
                    <a href="#" class="btn btn-icon btn-secondary btn-youtube">
                        <i class="bx bxl-youtube"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-1">
                <div class="d-flex flex-column h-100 shadow-sm rounded-3 overflow-hidden">
                    <iframe class="d-block h-100" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15789.424571830152!2d114.146301!3d-8.366583!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x25f7bbfdd70e1ed5!2sDamarlangit%20Musik!5e0!3m2!1sid!2sid!4v1605938699045!5m2!1sid!2sid" style="border: 0; min-height: 300px;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
