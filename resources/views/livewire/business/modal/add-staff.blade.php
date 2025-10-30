<div>
    <!-- Add Staff Modal -->
    <div wire:ignore.self class="modal fade" id="addstaffmodal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <form class="modal-content" wire:submit.prevent="AddStaff">

                <!-- Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Staff</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">

                    <!-- Full Name -->
                    <div class="form-group mb-3">
                        <label for="full_name">Full Name</label>
                        <input type="text" wire:model="full_name" id="full_name" class="form-control" placeholder="Enter full name">
                        @error('full_name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Gender -->
                    <div class="form-group mb-3">
                        <label for="gender">Gender</label>
                        <select wire:model="gender" id="gender" class="form-control">
                            <option value="">-- Select Gender --</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error('gender') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Birthday -->
                    <div class="form-group mb-3">
                        <label for="birthday">Birthday</label>
                        <input type="date" wire:model="birthday" id="birthday" class="form-control">
                        @error('birthday') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Picture Upload -->
                    <div class="form-group mb-3">
                        <label for="picture">Picture</label>
                        <input type="file" wire:model="picture" id="picture" class="form-control">
                        @error('picture') <span class="text-danger small">{{ $message }}</span> @enderror

                        <!-- Loading Indicator -->
                        <div wire:loading wire:target="picture" class="text-info small mt-1">
                            Uploading picture...
                        </div>

                        <!-- Preview -->
                        @if ($picture)
                            <img src="{{ $picture->temporaryUrl() }}" alt="Preview" class="img-thumbnail mt-2" width="120">
                        @endif
                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Staff</button>
                </div>

            </form>
        </div>
    </div>
</div>
