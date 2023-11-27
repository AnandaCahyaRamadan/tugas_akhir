<header class="header navbar navbar-expand-lg navbar-sticky">
    <div class="container px-3">
      <a href="" class="navbar-brand pe-3 pt-2">
        <img src="template1/img/logo.webp" width="90" />
      </a>
      <div id="navbarNav" class="offcanvas offcanvas-end">
        <div class="offcanvas-header border-bottom">
          <h5 class="offcanvas-title">Menu</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="offcanvas"
            aria-label="Close"
          ></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li>
              <a href="/" class="nav-link {{ Request::is ('/') ? 'active' : '' }}">Beranda</a>
            </li>
            <li>
              <a href="{{ route('tentang') }}" class="nav-link {{ Request::is ('tentang-kami') ? 'active' : '' }}">Tentang Kami</a>
            </li>
            <li>
              <a href="{{ route('hubungi-kami') }}" class="nav-link {{ Request::is ('hubungi-kami') ? 'active' : '' }}">Hubungi Kami</a>
            </li>
          </ul>
          <a
          href="{{ route('login') }}"
          class="btn btn-primary btn-sm fs-sm rounded d-lg-none"
          rel="noopener">
          &nbsp;Login
          </a>
        </div>
      </div>
      <div
        class="form-check form-switch mode-switch pe-lg-1 ms-auto me-4"
        data-bs-toggle="mode"
      >
        <input type="checkbox" class="form-check-input" id="theme-mode" />
        <label class="form-check-label d-none d-sm-block" for="theme-mode"
          >Light</label
        >
        <label class="form-check-label d-none d-sm-block" for="theme-mode"
          >Dark</label
        >
      </div>
      
      <button
        type="button"
        class="navbar-toggler"
        data-bs-toggle="offcanvas"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <a
        href="{{ route('login') }}"
        class="btn btn-primary btn-sm fs-sm rounded d-none d-lg-inline-flex"
        rel="noopener"
      >
        &nbsp;Login
      </a>
    </div>
  </header>