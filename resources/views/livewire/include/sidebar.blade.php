
<aside class="navbar navbar-vertical navbar-expand-lg d-print-none  " data-bs-theme="dark">

    <div class="container-fluid" >
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="text-center border-top border-bottom py-3">
    <img src="{{ asset('images/AuraCare_Logo.png') }}" 
         alt="Aura Care" 
         class="img-fluid" 
         style="max-width: 70px; height: auto;">
</div>

      <h1 class="navbar-brand navbar-brand-autodark">
        <a href="#" class="f-5">
          AURA CARE
        </a>
      </h1>
      <div class="navbar-nav flex-row d-lg-none">

        <div class="nav-item dropdown">
          <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
            <!-- <span class="avatar avatar-sm rounded-circle" style="background-image: url({{asset('images/AuraCare_Logo.png')}})"></span> -->
            
            <div class="d-none d-xl-block ps-2">
                <div>{{ auth('web')->User()->user_name }}</div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

            <a href="#" class="dropdown-item" wire:click.prevent="LogoutHandler()">Log Out</a>
          </div>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="sidebar-menu" >
        <ul class="navbar-nav pt-lg-3">

            <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard')}}" wire:navigate >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg class="icon icon-tabler icon-tabler-layout-dashboard" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 4h6v8h-6z"></path>
                            <path d="M4 16h6v4h-6z"></path>
                            <path d="M14 12h6v8h-6z"></path>
                            <path d="M14 4h6v4h-6z"></path>
                        </svg>
                    </span>
                  <span class="nav-link-title">
                    Dashboard
                  </span>
                </a>
            </li>

  @can ('AdminRole', '/App/Models/User')
            <li class="hr-text m-2">Admin Panel</li>
             <li class="nav-item {{ Route::is('admin.registered') ? 'active' : '' }}">
              <a  href="{{ route('admin.registered')}}" class="nav-link "  wire:navigate >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg class="icon icon-tabler icon-tabler-users-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                          <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                          <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                      </svg>
                  </span>
              <span class="nav-link-title">
                  Registered Business
              </span>
              </a>
          </li>


            {{-- <li class="nav-item {{ Route::is('admin.user-management') ? 'active' : '' }}">
              <a  href="{{ route('admin.user-management')}}" class="nav-link "  wire:navigate >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg class="icon icon-tabler icon-tabler-users-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                          <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                          <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                      </svg>
                  </span>
              <span class="nav-link-title">
                  User Management
              </span>
              </a>
          </li> --}}
@endcan

  @can ('BusinessRole', '/App/Models/User')
            {{-- Business Owner Panel --}}
           <li class="hr-text m-2">Business Owner Panel</li>
<li class="nav-item {{ Route::is('business-owner.booking') ? 'active' : '' }}">
              <a  href="{{ route('business-owner.booking')}}" class="nav-link "  wire:navigate >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg class="icon icon-tabler icon-tabler-users-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                          <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                          <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                      </svg>
                  </span>
              <span class="nav-link-title">
                  Booking
              </span>
              </a>
          </li>

          <li class="nav-item {{ Route::is('business-owner.services') ? 'active' : '' }}">
              <a  href="{{ route('business-owner.services')}}" class="nav-link "  wire:navigate >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg class="icon icon-tabler icon-tabler-users-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                          <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                          <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                      </svg>
                  </span>
              <span class="nav-link-title">
                  Services
              </span>
              </a>
          </li>
            
          <li class="nav-item {{ Route::is('business-owner.review') ? 'active' : '' }}">
              <a  href="{{ route('business-owner.review')}}" class="nav-link "  wire:navigate >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg class="icon icon-tabler icon-tabler-users-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                          <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                          <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                      </svg>
                  </span>
              <span class="nav-link-title">
                  Reviews and Ratings
              </span>
              </a>
          </li>

            <li class="nav-item {{ Route::is('business-owner.account') ? 'active' : '' }}">
              <a  href="{{ route('business-owner.account')}}" class="nav-link "  wire:navigate >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg class="icon icon-tabler icon-tabler-users-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                          <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                          <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                      </svg>
                  </span>
              <span class="nav-link-title">
                  Account
              </span>
              </a>
          </li>
          @endcan


            @can ('CustomerRole', '/App/Models/User')
          {{-- Customer Owner Panel --}}
           <li class="hr-text m-2">Customer Panel</li>
<li class="nav-item {{ Route::is('customer.home') ? 'active' : '' }}">
              <a  href="{{ route('customer.home')}}" class="nav-link "  wire:navigate >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg class="icon icon-tabler icon-tabler-users-group" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                          <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                          <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                          <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                      </svg>
                  </span>
              <span class="nav-link-title">
                  Home
              </span>
              </a>
          </li>

          
@endcan
        </ul>
      </div>
    </div>
  </aside>