@extends('layouts.landingpage')

@section('title','Cover Partner - Dewangkara')

@section('content')

<main>
    <!-- Hero -->
    <section
    class="overflow-hidden pt-2 pt-md-4 pt-lg-5 pb-5"
    style="min-height: 100vh"
  >
    <div class="container pt-1 pt-sm-0">
      <div class="row align-items-center">
        <!-- Cursor parallax -->
        <div class="col-md-7 order-md-2 mb-3 mb-sm-2 mb-md-0">
          <div class="parallax" style="max-width: 650px">
            <div class="parallax-layer" data-depth="0.2">
              <img
                src="template1/img/landing/startup/hero/piano.webp"
                alt="gitar"
              />
            </div>
          </div>
        </div>
        <!-- Text + button -->
        <div class="col-md-5 order-md-1">
          <h1 class="display-6 mb-ms-4">Menjamin karya cover partner secara aman & legal.</h1>
          <p class="fs-xl pb-2 mb-4 mb-xl-5" style="max-width: 450px">
            Cover partner dapat terus berkarya tanpa masalah hak cipta. 
          </p>
          <div
            class="position-relative d-md-none d-lg-block mb-4"
            style="max-width: 416px"
          >
            <i
              class="bx bxl-kickstarter d-flex d-dark-mode-none justify-content-center align-items-center position-absolute bg-dark fs-lg text-white rounded-1"
              style="
                top: 0;
                left: 63%;
                width: 1.5rem;
                height: 1.5rem;
                margin-top: -0.525rem;
                margin-left: -0.5rem;
              "
            ></i>
            <i
              class="bx bxl-kickstarter d-none d-dark-mode-flex justify-content-center align-items-center position-absolute bg-white fs-lg badge text-dark rounded-1 p-0"
              style="
                top: 0;
                left: 63%;
                width: 1.5rem;
                height: 1.5rem;
                margin-top: -0.525rem;
                margin-left: -0.5rem;
              "
            ></i>
            <div class="progress" style="height: 6px">
              <div
                class="progress-bar bg-success"
                role="progressbar"
                style="width: 100%"
                aria-valuenow="63"
                aria-valuemin="0"
                aria-valuemax="100"
              ></div>
            </div>
          </div>
          <ul
            class="list-unstyled d-md-none d-lg-block pb-1 pb-xl-0 mb-4 mb-xl-5"
          >
            <li class="d-flex align-items-center mb-2">
              <i class="bx bx-check-circle fs-xl text-primary me-2"></i>
              {{ $katalog }} katalog lagu
            </li>
            <li class="d-flex align-items-center mb-2">
              <i class="bx bx-check-circle fs-xl text-primary me-2"></i>
              {{ $channel }} channel partner
            </li>
            <li class="d-flex align-items-center mb-2">
              <i class="bx bx-check-circle fs-xl text-primary me-2"></i>
              {{ $katalog_lisensi }} lagu terlisensi
            </li>
          </ul>
          <a href="{{ route('hubungi-kami') }}" class="btn btn-lg btn-primary w-100 w-sm-auto">
            Bergabung Sekarang
            <i class="bx bx-right-arrow-alt lead ms-2 me-n1"></i>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Lindungi -->
  <section class="position-relative pt-sm-2 pt-md-4 pt-lg-5">
    <div
      class="bg-gradient-primary position-absolute top-0 start-0 w-100 opacity-15"
      style="height: calc(100%)"
    ></div>
    <div class="container position-relative pt-5">
      <div
        class="row row-cols-1 row-cols-md-2 pt-2 pt-md-3 pb-5"
      >
        <div class="col mb-4">
          <h2 class="h1 mb-0">
            Bergabung dengan DPS,
            <span class="text-primary">Berkarya</span> tanpa khawatir
            <span class="text-primary">hak cipta.</span>
          </h2>
        </div>
        <div class="col">
          <p class="fs-xl" style="text-align:justify">
            DPS (Dewangkara Pujangga Sejahtera) adalah wadah bagi para cover partner untuk membuat sebuah karya cover dengan legal dan aman. 
            DPS memastikan antara para pemilik lagu dan cover partner tidak terjadi perselisihan antara hak cipta dan hak royalti yang akan diterima.
          </p>
        </div>
      </div>
    </div>
  </section>
  
   <!-- Partner (Carousel) -->
    <section class="container pb-5 pt-5 mt-2 mt-md-4 mt-lg-5">
      <div class="d-flex align-items-center justify-content-md-between justify-content-center mb-md-4 mb-3">
        <h2 class="mb-0">Our Partner</h2>

        <!-- Slider prev/next buttons + Quotation mark -->
        <div class="d-md-flex d-none ms-4">
          <button type="button" id="prev-brand" class="btn btn-prev btn-icon btn-sm me-2">
            <i class="bx bx-chevron-left"></i>
          </button>
          <button type="button" id="next-brand" class="btn btn-next btn-icon btn-sm ms-2">
            <i class="bx bx-chevron-right"></i>
          </button>
        </div>
      </div>
      <div class="swiper mx-n2" data-swiper-options='{
          "slidesPerView": 2,
          "navigation": {
            "prevEl": "#prev-brand",
            "nextEl": "#next-brand"
          },
          "loop": true,
          "pagination": {
            "el": ".swiper-pagination",
            "clickable": true
          },
          "breakpoints": {
            "500": {
              "slidesPerView": 3,
              "spaceBetween": 8
            },
            "650": {
              "slidesPerView": 4,
              "spaceBetween": 8
            },
            "900": {
              "slidesPerView": 5,
              "spaceBetween": 8
            },
            "1100": {
              "slidesPerView": 6,
              "spaceBetween": 8
            }
          }
        }'>
        <div class="swiper-wrapper">

          <div class="swiper-slide py-3">
            <img src="https://damarlangit.co.id/assets/images/partner/YouTube.png" width="175" alt="Partner" style="background-color: white">
          </div>
          <div class="swiper-slide py-3">
            <img src="https://damarlangit.co.id/assets/images/partner/Facebook.png" width="175" alt="Partner" style="background-color: white">
          </div>
          <div class="swiper-slide py-3">
            <img src="https://damarlangit.co.id/assets/images/partner/TikTok.png" width="175" alt="Partner" style="background-color: white">
          </div>
          <div class="swiper-slide py-3">
            <img src="https://damarlangit.co.id/assets/images/partner/Spotify.png" width="175" alt="Partner" style="background-color: white">
          </div>
          <div class="swiper-slide py-3">
            <img src="https://damarlangit.co.id/assets/images/partner/Instagram.png" width="175" alt="Partner" style="background-color: white">
          </div>
          <div class="swiper-slide py-3">
            <img src="{{ asset('template1/img/deezer.jpg') }}" width="175" alt="Partner" style="background-color: white">
          </div>
          <div class="swiper-slide py-3">
            <img src="{{ asset('template1/img/itunes.png') }}" width="175" alt="Partner" style="background-color: white">
          </div>
          <div class="swiper-slide py-3">
            <img src="{{ asset('template1/img/joox.jpg') }}" width="175" alt="Partner" style="background-color: white">
          </div>

        </div>

        <!-- Pagination (bullets) -->
        <div class="swiper-pagination position-relative pt-3 mt-4 d-md-none d-flex"></div>
      </div>
    </section>
    
  <!-- Top hits-->
  <section
    class="bg-secondary overflow-hidden py-2 py-sm-3 py-md-4 py-lg-5"
  >
    <h2 class="display-5 text-center pt-5 pb-3 pb-md-4 pb-lg-5 mb-xl-4">
      Top Hits
    </h2>
    <!-- Multiple slides responsive slider with external Prev / Next buttons and bullets outside -->
    <div class="position-relative px-xl-5 container">
      <!-- Slider prev/next buttons -->
      <button
        type="button"
        id="prev-news"
        class="btn btn-prev btn-icon btn-sm position-absolute top-50 start-0 translate-middle-y d-none d-xl-inline-flex"
      >
        <i class="bx bx-chevron-left"></i>
      </button>
      <button
        type="button"
        id="next-news"
        class="btn btn-next btn-icon btn-sm position-absolute top-50 end-0 translate-middle-y d-none d-xl-inline-flex"
      >
        <i class="bx bx-chevron-right"></i>
      </button>

      <!-- Slider -->
      <div class="px-xl-2">
        <div
          class="swiper mx-n2"
          data-swiper-options='{
      "slidesPerView": 1,
      "loop": true,
      "pagination": {
        "el": ".swiper-pagination",
        "clickable": true
      },
      "navigation": {
        "prevEl": "#prev-news",
        "nextEl": "#next-news"
      },
      "breakpoints": {
        "500": {
          "slidesPerView": 2
        },
        "1000": {
          "slidesPerView": 2
        }
      }
    }'
        >
          <div class="swiper-wrapper">
            <!-- Item -->
            @foreach($tophits as $key => $tophit)
            <div class="swiper-slide h-auto pb-3 p-2">
              <iframe
                width="560"
                height="315"
                src="{{ $tophit->link }}"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen
              ></iframe>
            </div>
            @endforeach
          </div>

          <!-- Pagination (bullets) -->
          <div
            class="swiper-pagination position-relative bottom-0 mt-4 mb-lg-2"
          ></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimoni -->
  <section class="container pb-md-3 pb-lg-4 pb-xl-0 pt-sm-2 pt-md-3 pt-lg-5 mt-2 mt-md-3 mb-5">
    <h2 class="display-5 text-center pt-5 pb-3 pb-md-4 pb-lg-5 mb-xl-4">
      Testimoni
    </h2>
    <!-- Testimonials slider: Style 2. Should be placed inside .container -->
    <div class="row">
      <div class="col-md-3 d-none d-md-block">
        <!-- Swiper tabs (Author images) -->
        <div class="swiper-tabs">
          <!-- Author 1 image -->
          @foreach ($testimoni as $key => $row)
          <div id="author{{ $key }}" class="card bg-transparent border-0 swiper-tab @if ($key == 0) active @endif">
            <div
              class="card-body p-0 rounded-3 bg-size-cover bg-repeat-0 bg-position-top-center"
              style="
                background-image: url({{ asset('storage/' . $row->User->avatar) }});
              "
            ></div>
            <div class="card-footer d-flex w-100 border-0 pb-0">
              <div class="border-start-xl ps-xl-4 ms-xl-2">
                <h5 class="fw-semibold lh-base mb-0">{{ $row->User->nama }}</h5>
                <span class="fs-sm text-muted">
                    @if (implode(', ', $row->User->getRoleNames()->toArray()) == 'cover-patner') 
                    Cover Partner
                    @endif
                    @if (implode(', ', $row->User->getRoleNames()->toArray()) == 'publisher') 
                    Publisher
                    @endif
                </span>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="col-md-9">
        <div class="card border-0 shadow-sm p-4 p-xxl-5 ms-xxl-5">
          <!-- Slider prev/next buttons + Quotation mark -->
          <div class="d-flex justify-content-between pb-4 mb-2">
            <span
              class="btn btn-icon btn-primary btn-lg shadow-primary pe-none"
            >
              <i class="bx bxs-quote-left"></i>
            </span>
            <div class="d-flex">
              <button
                type="button"
                id="prev2"
                class="btn btn-prev btn-icon btn-sm me-2"
              >
                <i class="bx bx-chevron-left"></i>
              </button>
              <button
                type="button"
                id="next2"
                class="btn btn-next btn-icon btn-sm ms-2"
              >
                <i class="bx bx-chevron-right"></i>
              </button>
            </div>
          </div>

          <!-- Slider -->
          <div
            class="swiper mx-0 mb-md-n2 mb-xxl-n3"
            data-swiper-options='{
    "spaceBetween": 24,
    "loop": true,
    "tabs": true,
    "pagination": {
      "el": ".swiper-pagination",
      "clickable": true
    },
    "navigation": {
      "prevEl": "#prev2",
      "nextEl": "#next2"
    }
  }'
          >
            <div class="swiper-wrapper">
              <!-- Item -->
              @foreach ($testimoni as $key => $row1)
              <div class="swiper-slide h-auto" data-swiper-tab="#author{{ $key }}">
                <figure
                  class="card h-100 position-relative border-0 bg-transparent"
                >
                  <blockquote class="card-body p-0 mb-0">
                    <p class="fs-lg mb-0">
                      {{ $row1->testimoni }}
                    </p>
                  </blockquote>
                  <figcaption
                    class="card-footer border-0 d-sm-flex d-md-none w-100 pb-2"
                  >
                    <div
                      class="d-flex align-items-center pe-sm-4 me-sm-2"
                    >
                      <img
                        src="{{ asset('storage/' . $row1->User->avatar) }}"
                        width="48"
                        class="rounded-circle"
                      />
                      <div class="ps-3">
                        <h5 class="fw-semibold lh-base mb-0">
                          {{ $row1->User->nama }}
                        </h5>
                        <span class="fs-sm text-muted">  
                          @if (implode(', ', $row1->User->getRoleNames()->toArray()) == 'cover-patner') 
                          Cover Partner
                          @endif
                          @if (implode(', ', $row1->User->getRoleNames()->toArray()) == 'publisher') 
                          Publisher
                          @endif</span
                        >
                      </div>
                    </div>
                  </figcaption>
                </figure>
              </div>
              @endforeach
            </div>

            <!-- Pagination (bullets) -->
            <div
              class="swiper-pagination position-relative pt-3 mt-4 d-none d-md-flex"
            ></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<script defer>
  document.addEventListener("DOMContentLoaded", function() {
      // Mendapatkan semua elemen iframe dengan class async-iframe
      var iframes = document.querySelectorAll(".async-iframe");

      // Iterasi melalui semua iframe dan mengatur atribut src masing-masing
      iframes.forEach(function(iframe) {
          var dataLink = iframe.getAttribute("data-link");
          setTimeout(function() {
              iframe.src = dataLink;
          }, 0); // Ganti angka 1000 dengan waktu penundaan yang sesuai (dalam milidetik)
      });
  });
</script>
@endsection


