<div>
    <div wire:ignore.self class="modal fade" id="createRole" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

            <form class="modal-content" method="POST" wire:submit.prevent="updateRole()">
                <div class="modal-header">
                    <h5 class="modal-title">Update Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="card">
                        <div class="card-header text-muted text-xs  bg-light">Role Information</div>
                        <div class="card-body">

                            @if(!is_null($TempMultipleRole))
                            <div class="row">
                                @forelse ( $TempMultipleRole as $Role )
                                <h4 class="mb-1 ml-2">{{$Role[1]}}
                                    <a href="#" class="text-danger mx-2"
                                        wire:click.prevent="removefromRole({{$Role[0]}})">Remove</a>
                                </h4>
                                @empty
                                <div class="fs-4 text-muted text-center" role="alert">
                                    <div class="m-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-alert-triangle text-danger" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 9v4"></path>
                                            <path
                                                d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z">
                                            </path>
                                            <path d="M12 16h.01"></path>
                                        </svg>
                                    </div>
                                    <div class="m-1">
                                        I'm so sorry. No Role for this User
                                    </div>
                                </div>
                                @endforelse
                            </div>
                            @endif

                            <div class="hr mx-2"></div>

                            <div class="col-12 col-sm-12 col-md-12 mb-3">
                                <label class="form-label">Role Name</label>
                                <select class="form-select  @error('SelectedRole') is-invalid @enderror"
                                    data-placeholder="Select Role" id="floating-input" wire:model="SelectedRole">
                                    <option value="" selected>--- Choose Option ---</option>
                                    @forelse ($Roles as $Role)
                                        @IF($Role->id != 1)
                                        <option value="{{ $Role->id}}"> {{ $Role->role_name }}</option>
                                        @endif
                                    @empty

                                    @endforelse
                                </select>
                                @error('SelectedRole')
                                <p class="text-danger text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>

                            <button class="btn btn-info" wire:click.prevent="addtoMultipleRole()">Add Role</button>


                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal"> Close</button>
                    @if(!is_null($TempMultipleRole))
                    <button type="submit" class="btn btn-primary">Update Role</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
