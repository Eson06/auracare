<div>
    <!-- Add Payment Modal -->
    <div wire:ignore.self class="modal fade" id="accountmodal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <form class="modal-content" wire:submit.prevent="AddPayment">

                <!-- Header -->
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Add Payment Method</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">

                        <div class="form-group mb-3">
        <label for="type_account">Type of Account</label>
        <select wire:model="type_account" id="type_account" class="form-control">
            <option value="">-- Select Type --</option>
            <option value="GCash">GCash</option>
            <option value="Maya">Maya</option>
        </select>
        @error('type_account') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

                    <!-- Account Name -->
                    <div class="form-group mb-3">
                        <label for="name">Account Name</label>
                        <input type="text" wire:model="name" id="name" class="form-control" placeholder="Enter account name">
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Account Number -->
                    <div class="form-group mb-3">
                        <label for="number">Account Number</label>
                        <input type="text" wire:model="number" id="number" class="form-control" placeholder="Enter account number">
                        @error('number') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- QR Upload -->
                    <div class="form-group mb-3">
                        <label for="qr">QR Code</label>
                        <input type="file" wire:model="qr" id="qr" class="form-control">
                        @error('qr') <span class="text-danger small">{{ $message }}</span> @enderror

                        <!-- Loading Indicator -->
                        <div wire:loading wire:target="qr" class="text-info small mt-1">
                            Uploading QR code...
                        </div>

                        <!-- Preview -->
                        @if ($qr)
                            <img src="{{ $qr->temporaryUrl() }}" alt="QR Preview" class="img-thumbnail mt-2" width="120">
                        @endif
                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Payment</button>
                </div>

            </form>
        </div>
    </div>
</div>
