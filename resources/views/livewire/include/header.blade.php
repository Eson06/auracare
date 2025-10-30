<div>
    <header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">

            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">

                <div class="d-none d-xl-block text-end ps-2">
                    <p class="alert alert-warning mt-2" wire:offline>
                        Whoops, your device has lost connection. The web page you are viewing is offline.
                    </p>
                </div>
                <div class="d-none d-xl-block text-end ps-2">
                  {{ auth('web')->user()->first_name }} {{ auth('web')->user()->last_name }}
                  <div class="mt-1 small text-secondary"> {{ auth('web')->user()->user_name }}</div>
                </div>
                <!-- <span class="avatar avatar-sm rounded-circle mx-2" style="background-image:url({{asset('images/logo.png')}})"></span> -->
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                {{-- <a href="#" class="dropdown-item" data-bs-toggle="tooltip" data-bs-placement="left" title="Setting Your own Profile" wire:navigate>Change Profile</a> --}}
                {{-- <div class="dropdown-divider mx-2 my-0"></div> --}}
                <a href="#" class="dropdown-item" wire:click.prevent="LogoutHandler()">Logout</a>
              </div>
            </div>
          </div>
          <div class="collapse navbar-collapse" id="navbar-menu">
          </div>
        </div>
      </header>

</div>

