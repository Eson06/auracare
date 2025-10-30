<div>
    <!-- 🟦 Checkout Modal -->
    <div wire:ignore.self class="modal fade" id="checkoutmodal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form class="modal-content shadow-lg border-0 rounded-4" wire:submit.prevent="AddOrder">

                <!-- Header -->
                <div class="modal-header bg-primary text-white rounded-top-4">
                    <h5 class="modal-title fw-semibold"><i class="fas fa-shopping-cart me-2"></i>Checkout</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <!-- Body -->
                <div class="modal-body p-4" style="max-height: 80vh; overflow-y: auto;">
                    <div class="row g-4">
                        
                        <!-- Left: Payment Options -->
                        <div class="col-md-4 border-end">
                            <h6 class="fw-bold mb-3 text-primary">
                                <i class="fas fa-wallet me-2"></i>Payment Options
                            </h6>
                        
                            @if ($payments->isEmpty())
                                <div class="alert alert-warning text-center shadow-sm rounded-3">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    No payment available yet.
                                </div>
                            @else
                                @foreach ($payments as $payment)
                                    <div class="card border-0 shadow-sm mb-3 rounded-3">
                                        <div class="card-body p-3">
                                            <h6 class="text-primary mb-2">
                                                <i class="fas fa-credit-card me-2"></i>{{ $payment->type_account }}
                                            </h6>
                                            <p class="mb-1"><strong>Name:</strong> {{ $payment->name }}</p>
                                            <p class="mb-1"><strong>Number:</strong> {{ $payment->number }}</p>
                        
                                            @if ($payment->qr)
                                                <div class="text-center mt-2">
                                                    <img src="{{ asset('storage/' . $payment->qr) }}" 
                                                         alt="QR Code" 
                                                         class="img-fluid rounded shadow-sm border" 
                                                         style="max-width: 120px;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                
                        <!-- Right: Order Details -->
                        <div class="col-md-8">
                            <h6 class="fw-bold mb-3 text-primary"><i class="fas fa-receipt me-2"></i>Order Details</h6>
                
                            <!-- Order Summary -->
                            <div class="card shadow-sm border-0 mb-4 rounded-3">
                                <div class="card-body bg-light">
                                    <h6 class="fw-semibold text-muted mb-3">Order Summary</h6>
                                    <p class="mb-1"><strong>Service Name:</strong> {{ $name_service }}</p>
                                    <p class="mb-1"><strong>Type:</strong> {{ $type_service }}</p>
                                    <p class="mb-0"><strong>Price:</strong> ₱{{ $price }}</p>
                                </div>
                            </div>
                
                            <!-- Schedule Section -->
                            <h6 class="fw-bold text-primary mb-3">
                                <i class="fas fa-calendar-alt me-2"></i>Schedule
                            </h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Date of Schedule</label>
                                    <input type="date" wire:model="date_schdedule" class="form-control shadow-sm rounded-3">
                                    @error('date_schdedule') 
                                        <span class="text-danger small">{{ $message }}</span> 
                                    @enderror
                                </div>
                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Select Time</label>
                                    <select wire:model.lazy="selected_time" class="form-select shadow-sm rounded-3">
                                        <option value="">-- Select Time --</option>
                                        @foreach ($this->availableTimes as $time)
                                            <option value="{{ $time }}">{{ $time }}</option>
                                        @endforeach
                                    </select>
                                    @error('selected_time') 
                                        <span class="text-danger small">{{ $message }}</span> 
                                    @enderror
                                </div>
                            </div>
                
                            <!-- Proof of Payment -->
                            <div class="mb-3">
                                <label for="picture" class="form-label fw-semibold">Proof of Payment</label>
                                <input type="file" wire:model="picture" id="picture" class="form-control shadow-sm rounded-3">
                                @error('picture') 
                                    <span class="text-danger small">{{ $message }}</span> 
                                @enderror
                
                                <div wire:loading wire:target="picture" class="text-info small mt-1">
                                    Uploading picture...
                                </div>
                
                                @if ($picture)
                                    <div class="mt-3">
                                        <img src="{{ $picture->temporaryUrl() }}" alt="Preview" class="img-thumbnail shadow-sm border rounded-3" width="130">
                                    </div>
                                @endif
                            </div>
                
                            <!-- Payment Option -->
                            <div class="mb-3">
                                <label for="amount_paid" class="form-label fw-semibold">Payment Option</label>
                                <select wire:model.lazy="payment_option" id="payment_option" class="form-select shadow-sm rounded-3">
                                    <option value="">-- Select Payment Option --</option>
                                    <option value="full">Full Payment</option>
                                    <option value="half">Half Payment</option>
                                </select>
                                @error('payment_option') 
                                    <span class="text-danger small">{{ $message }}</span> 
                                @enderror
                
                                @if ($payment_option)
                                    <div class="mt-3">
                                        <label class="form-label fw-semibold">Amount to Pay</label>
                                        <div class="input-group shadow-sm rounded-3">
                                            <span class="input-group-text bg-primary text-white fw-bold">₱</span>
                                            <input type="text" 
                                                class="form-control" 
                                                value="{{ $payment_option === 'full' ? $price : $price / 2 }}" 
                                                readonly>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                

                <!-- Footer -->
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-secondary rounded-3 px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4">
                        <i class="fas fa-check me-2"></i>Reserved
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
