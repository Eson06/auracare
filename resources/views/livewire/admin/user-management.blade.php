<div>
    @section ('pageTitle',isset($pageTitle) ? $pageTitle : 'User Management')

    <ol class="breadcrumb fs-3" aria-label="breadcrumbs">

        <li class="breadcrumb-item active text-muted" aria-current="page">Admin Panel</a></li>
        <li class="breadcrumb-item active text-muted" aria-current="page">User Management</a></li>
    </ol>


    <div wire:loading>
        <div class="col-12 loading-page">
            <h1 class="">Loading<span class="animated-dots"></span></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12 col-sm-12">

            <a href="#" class="btn btn-primary mb-2 mt-4" data-bs-toggle="modal" data-bs-target="#createUser">
                <svg  class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 5l0 14"></path>
                    <path d="M5 12l14 0"></path>
                 </svg>
                New User
            </a>

        </div>


        <div class="hr-text">User List</div>

        <div class="col-12 col-md-12 col-sm-12">

            <div class="input-icon mb-3 ms-auto">
                <input type="text" value="" class="form-control" placeholder="Search" wire:model.live.debounce.500ms="Search">
                <span class="input-icon-addon">
                    <div class="spinner-border spinner-border-sm text-secondary" role="status" wire:loading wire:target="Search"></div>
                    <svg wire:loading.attr="hidden" wire:target="Search"  class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                    <path d="M21 21l-6 -6"></path>
                    </svg>
                </span>
            </div>

            @if($count != 0)
            <div class="text-md-left text-muted text-center my-4">
                Showing
                <strong>{{ $limitPerPage }}</strong>
                 of
                <strong>{{ $count }}</strong>
                {{ Str::plural('Entry',$count)}}
            </div>
            @endif
        </div>
    </div>



    <div class="row">
        @forelse ($Users as $index => $User)
        <div class="col-12 col-md-12 col-sm-12 my-2" wire:key="{{ $User->id }}">

            <div class="card  @if($index % 2 == 0) bg-gray-500 @endif">
                <div class="card-header">
                  <div>
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <!-- <span class="avatar avatar-lg rounded-circle" style="background-image: url({{asset('images/cnhs_logo.png')}})"></span> -->
                      </div>
                      <div class="col">
                        <div class="card-title">    
                             {{ $User->user_name }}
                            @if($User->is_enable == false)
                            <span class="badge badge-sm bg-danger p-1 ">Inactive</span>
                            @else
                            <span class="badge badge-sm bg-success p-1 ">Active</span>
                            @endif
                        </div>

                       
                        <div class="card-description">
                            <svg  class="icon icon-tabler icon-tabler-user mx-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                             </svg>
                             {{ $User->firstname }} {{ $User->lastname }}
                        </div>

                        <div class="card-description">

                        
                             <span class="badge badge-sm bg-info m-1 ">{{ $User->Roles->Role->role_name }}</span>
                      
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="card-actions">
                    <a href="#" class="btn-action" data-bs-toggle="dropdown">
                        <svg  class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path></svg>
                      </a>
                      <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                        <a class="dropdown-item" href="#" wire:click.prevent="editUser({{ $User->id }})">
                            <svg  class="icon icon-tabler icon-tabler-edit mx-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                             </svg>
                            Edit
                        </a>

                        <!-- <a class="dropdown-item" href="#" wire:click.prevent="editRole({{ $User->id }})">
                            <svg  class="icon icon-tabler icon-tabler-user-cog mx-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h2.5"></path>
                                <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M19.001 15.5v1.5"></path>
                                <path d="M19.001 21v1.5"></path>
                                <path d="M22.032 17.25l-1.299 .75"></path>
                                <path d="M17.27 20l-1.3 .75"></path>
                                <path d="M15.97 17.25l1.3 .75"></path>
                                <path d="M20.733 20l1.3 .75"></path>
                             </svg>
                            Role
                        </a> -->


                        @if($User->is_enable == false)
                        <a class="dropdown-item" href="#" wire:click.prevent="activateUser({{ $User->id }})">
                            <svg  class="icon icon-tabler icon-tabler-check mx-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                             </svg>
                            Activate
                        </a>
                        @else
                        <a class="dropdown-item" href="#" wire:click.prevent="deactivateUser({{ $User->id }})">
                            <svg  class="icon icon-tabler icon-tabler-x mx-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M18 6l-12 12"></path>
                                <path d="M6 6l12 12"></path>
                             </svg>
                            Deactivate
                        </a>
                        @endif
                      </div>
                  </div>

                </div>
            </div>
        </div>

        @empty

        <div class="fs-4 text-muted text-center" role="alert">
            <div class="m-1">
                <svg  class="icon icon-tabler icon-tabler-alert-triangle text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 9v4"></path>
                    <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path>
                    <path d="M12 16h.01"></path>
                 </svg>
            </div>
            <div class="m-1">
                I'm so sorry. No result found
            </div>
        </div>

        @endforelse

        @if($hasMore == true)
            <div class="text-center m-2">
                <a href="#" class="btn btn-blue" wire:click.prevent="loadMore()">Load More Data<a>
            </div>

        @endif

    </div>



    @include('livewire.admin.modal.create-user')
    @include('livewire.admin.modal.activate-user')
    @include('livewire.admin.modal.create-role')


   @push('scripts')
    <script data-navigate-once>
        document.addEventListener('livewire:navigated', () => {

            Livewire.on('showCreateUserModal', (event) => {
                $('#createUser').modal('show');
            });

            Livewire.on('closeCreateUserModal', (event) => {
                $('#createUser').modal('hide');
            });


            Livewire.on('showActivateUserModal', (event) => {
                $('#activateUserModal').modal('show');
            });

            Livewire.on('closeActivateUserModal', (event) => {
                $('#activateUserModal').modal('hide');
            });

            Livewire.on('showCreateRoleModal', (event) => {
                $('#createRole').modal('show');
            });

            Livewire.on('closeCreateRoleModal', (event) => {
                $('#createRole').modal('hide');
            });



        });

    </script>
    @endpush


</div>
