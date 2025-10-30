<div>
    <!-- Add Service Modal -->
    <div wire:ignore.self class="modal fade" id="addservicesmodal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <form class="modal-content" wire:submit.prevent="AddServices">

                <!-- Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Service</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">

                    <!-- Service Name -->
                   <div class="form-group mb-3">
    <label for="type_service">Type of Service</label>
    <select wire:model="type_service" id="type_service" class="form-control">
        <option value="">-- Select Type of Service --</option>
        <option value="Massage Therapy">Massage Therapy</option>
        <option value="Facial Treatment">Facial Treatment</option>
        <option value="Hair Treatment">Hair Treatment</option>
        <option value="Nail Care">Nail Care</option>
        <option value="Body Scrub">Body Scrub</option>
        <option value="Waxing">Waxing</option>
        <option value="Makeup">Makeup</option>
        <option value="Spa Package">Spa Package</option>
        <option value="Salon Package">Salon Package</option>
    </select>
    @error('type_service') 
        <span class="text-danger small">{{ $message }}</span> 
    @enderror
</div>

<div class="form-group mb-3">
    <label for="name_service">Service Name</label>
    <select wire:model="name_service" id="name_service" class="form-control">
        <option value="">-- Select Service Name --</option>

        <!-- Massage Therapy -->
        <option value="Brazilian Massage">Brazilian Massage</option>
        <option value="Swedish Massage">Swedish Massage</option>
        <option value="Hot Stone Massage">Hot Stone Massage</option>
        <option value="Aromatherapy Massage">Aromatherapy Massage</option>
        <option value="Deep Tissue Massage">Deep Tissue Massage</option>

        <!-- Facial Treatment -->
        <option value="Deep Cleansing Facial">Deep Cleansing Facial</option>
        <option value="Anti-Aging Facial">Anti-Aging Facial</option>
        <option value="Hydrating Facial">Hydrating Facial</option>
        <option value="Whitening Facial">Whitening Facial</option>

        <!-- Hair Treatment -->
        <option value="Keratin Rebond">Keratin Rebond</option>
        <option value="Hair Spa">Hair Spa</option>
        <option value="Hot Oil Treatment">Hot Oil Treatment</option>
        <option value="Hair Coloring">Hair Coloring</option>

        <!-- Nail Care -->
        <option value="Manicure">Manicure</option>
        <option value="Pedicure">Pedicure</option>
        <option value="Gel Manicure">Gel Manicure</option>
        <option value="Nail Art">Nail Art</option>

        <!-- Body Scrub -->
        <option value="Sea Salt Scrub">Sea Salt Scrub</option>
        <option value="Coffee Scrub">Coffee Scrub</option>
        <option value="Milk Bath Scrub">Milk Bath Scrub</option>

        <!-- Waxing -->
        <option value="Full Body Wax">Full Body Wax</option>
        <option value="Underarm Wax">Underarm Wax</option>
        <option value="Bikini Wax">Bikini Wax</option>

        <!-- Makeup -->
        <option value="Bridal Makeup">Bridal Makeup</option>
        <option value="Event Makeup">Event Makeup</option>
        <option value="Natural Look Makeup">Natural Look Makeup</option>

        <!-- Spa Packages -->
        <option value="Relaxation Package">Relaxation Package</option>
        <option value="Detox Package">Detox Package</option>
        <option value="Couples Spa Package">Couples Spa Package</option>

        <!-- Salon Packages -->
        <option value="Full Glam Package">Full Glam Package</option>
        <option value="Hair & Makeup Combo">Hair & Makeup Combo</option>
        <option value="Complete Beauty Package">Complete Beauty Package</option>
    </select>
    @error('name_service') 
        <span class="text-danger small">{{ $message }}</span> 
    @enderror
</div>


                    <!-- Price -->
                    <div class="form-group mb-3">
                        <label for="price">Price</label>
                        <input type="number" wire:model="price" id="price" class="form-control" placeholder="Enter price">
                        @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea wire:model="description" id="description" class="form-control" placeholder="Enter service description"></textarea>
                        @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Assign Staff -->
                    <div class="form-group mb-3">
    <label for="staff_ids" class="fw-bold">Assign Staff</label>

    <div class="border rounded p-3" style="max-height: 250px; overflow-y: auto;">
        @foreach ($staffs as $staff)
            <div class="form-check mb-2">
                <input
                    type="checkbox"
                    wire:model="staff_ids"
                    value="{{ $staff->id }}"
                    id="staff_{{ $staff->id }}"
                    class="form-check-input"
                >
                <label for="staff_{{ $staff->id }}" class="form-check-label">
                    {{ $staff->full_name }}
                </label>
            </div>
        @endforeach
    </div>

    @error('staff_ids')
        <span class="text-danger small d-block mt-1">{{ $message }}</span>
    @enderror

    <small class="text-muted">Select one or more staff members.</small>
</div>


                    <!-- Picture Upload -->
                    <div class="form-group mb-3">
                        <label for="picture">Picture</label>
                        <input type="file" wire:model="picture" id="picture" class="form-control">
                        @error('picture') <span class="text-danger small">{{ $message }}</span> @enderror

                        <div wire:loading wire:target="picture" class="text-info small mt-1">
                            Uploading picture...
                        </div>

                        @if ($picture)
                            <img src="{{ $picture->temporaryUrl() }}" alt="Preview" class="img-thumbnail mt-2" width="120">
                        @endif
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Service</button>
                </div>

            </form>
        </div>
    </div>
</div>
