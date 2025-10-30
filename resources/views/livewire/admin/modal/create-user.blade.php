<div>
    <div wire:ignore.self class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

            <form class="modal-content" method="POST" wire:submit.prevent="addUser()">
                <div class="modal-header">
                    <h5 class="modal-title"> User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="card">
                        <div class="card-header text-muted text-xs  bg-light">User Information</div>
                        <div class="card-body">


                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"  maxlength="30"  autocomplete="off" oninput="this.value = this.value.toUpperCase()"  placeholder="Enter User Name" wire:model="name">
                                    <label for="name">Name</label>
                                    @error('name')
                                    <p class="text-danger text-xs mt-1">{{$message}}</p>
                                    @enderror
                                </div>

                            </div>

                              <div class="hr-text my-4">Log in Credentials</div>

                              <div class="col-12 col-sm-12 col-md-12">

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user_name"  maxlength="30"  autocomplete="off" oninput="this.value = this.value.toUpperCase()"  placeholder="Enter ID No." wire:model="user_name">
                                    <label for="user_name">ID No.</label>
                                    @error('user_name')
                                    <p class="text-danger text-xs mt-1">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3">
    <select class="form-select @error('role_id') is-invalid @enderror" 
            id="role_id" 
            wire:model="role_id">
        <option value="">-- Select Role --</option>
        <option value="2">Admin</option> <!-- Assuming ID 1 = Admin -->
        <option value="3">Teacher</option> <!-- Assuming ID 2 = Teacher -->
    </select>
    <label for="role_id">Role</label>
    @error('role_id')
        <p class="text-danger text-xs mt-1">{{$message}}</p>
    @enderror
</div>


                            </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal"> Close</button>
                    <button type="submit" class="btn btn-primary"> {{ $updateUser == true ? 'Update User' : 'Create User'}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

