<header id="page-topbar" style="background:#FFE3E4">
  <div class="navbar-header">
    <div class="d-flex">
      <!-- LOGO -->
      <div class="navbar-brand-box" style="background:#FFE3E4;">
        <a href="{{ url('/') }}" class="logo logo-dark">
          <span class="logo-sm">
            <img src="{{asset('backend/assets/images/logo.jpg')}}" alt="" height="22">
          </span>
          <span class="logo-lg">
            <img src="{{asset('backend/assets/images/logo.jpg')}}" alt="" height="17">
          </span>
        </a>

        <a href="{{ url('/') }}" class="logo logo-light">
          <span class="logo-sm">
            <img src="{{asset('backend/assets/images/logo.jpg')}}" alt="" height="30">
          </span>
          <span class="logo-lg">
            <img src="{{asset('backend/assets/images/logo.jpg')}}" alt="" height="60">
          </span>
        </a>
      </div>

      <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
      </button>

    </div>

    <div class="d-flex">
      
      @php
      $user = Auth::user();
      @endphp

      <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="d-none d-xl-inline-block ms-1" key="t-henry" style="font-weight:bold;">{{ $user->name }}</span>
          <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
          <!-- item-->
          <a class="dropdown-item" href="{{ route('edit.profile') }}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Perfil</span></a>
          <a class="dropdown-item" href="{{ route('change.password') }}"><i class="bx bx-wallet font-size-16 align-middle me-1"></i> <span key="t-my-wallet">Cambiar COntraseña</span></a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Cerrar Sesión</span></a>
        </div>
      </div>

    </div>
  </div>
</header>
