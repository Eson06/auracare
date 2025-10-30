<div>
    @section('pageTitle', isset($pageTitle) ? $pageTitle : 'Booking')

    <ol class="breadcrumb fs-4 mb-4">
        <li class="breadcrumb-item active text-muted" aria-current="page">Booking</li>
    </ol>

    <div wire:loading.flex class="justify-content-center my-3">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    
    <div class="container py-4">
        <h2 class="text-center text-primary fw-bold mb-5">Registered Salon & Spa Businesses</h2>

        <div class="d-flex align-items-center mb-4">
            <label class="me-2 fw-semibold text-secondary">Filter:</label>
            <div class="col-md-4">
                <select wire:model.lazy="filterType" class="form-select border-primary">
                    <option value="">All Business Types</option>
                    <option value="salon">Salon</option>
                    <option value="spa">Spa</option>
                    <option value="spa and salon">Spa and Salon</option>
                </select>
            </div>
        </div>
        
        

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse ($businesses as $business)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm text-center">
                        <div class="card-body">
                            {{-- Logo --}}
                            <div class="d-flex justify-content-center mb-3">
                                <img 
                                    src="{{ $business->picture ? asset('storage/' . $business->picture) : asset('images/No-Image.png') }}" 
                                    class="rounded-circle border border-3 border-light shadow"
                                    width="100" height="100" alt="Business Logo">
                            </div>

                            {{-- Business Info --}}
                            <h5 class="fw-semibold text-dark">{{ $business->business_name }}</h5>
                            <p class="text-muted mb-1">
                                <i class="bi bi-shop text-primary me-1"></i> {{ $business->business_type }}
                            </p>
                            <p class="text-muted small mb-2">
                                <i class="bi bi-geo-alt text-danger me-1"></i> {{ $business->business_address }}
                            </p>
                            <p class="text-muted small mb-2">
                                <i class="bi bi-clock text-warning me-1"></i> 
                                {{ $business->opening_time }} – {{ $business->closing_time }}
                            </p>
                            <p class="text-muted small mb-3">
                                <i class="bi bi-calendar-x text-secondary me-1"></i>
                                Expires: {{ \Carbon\Carbon::parse($business->expiration_date)->format('M d, Y') }}
                            </p>

                            {{-- Status --}}
                            @if ($business->status)
                                <span class="badge rounded-pill px-3 py-2 
                                    @if($business->status == 'approved') bg-success 
                                    @elseif($business->status == 'pending' || $business->status == 'Waiting for Approval') bg-warning text-dark
                                    @else bg-secondary @endif">
                                    {{ ucfirst($business->status) }}
                                </span>
                            @endif

                            {{-- Approve Button --}}
                            @if ($business->status !== 'approved')
                                <div class="mt-3">
                                    <button wire:click="approve({{ $business->id }})"
                                        class="btn btn-outline-success btn-sm rounded-pill">
                                        <i class="bi bi-check-circle me-1"></i> Approve
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-emoji-frown text-secondary fs-1 d-block mb-3"></i>
                    <p class="text-muted fs-5 mb-0">No registered businesses found.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
