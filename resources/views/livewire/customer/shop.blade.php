<div>
    @section('pageTitle', isset($pageTitle) ? $pageTitle : 'Home')

    <ol class="breadcrumb fs-3" aria-label="breadcrumbs">
        <li class="breadcrumb-item active text-muted" aria-current="page">Home</li>
        <li class="breadcrumb-item active text-muted" aria-current="page">{{ $business_name }}</li>
    </ol>

    <div class="container mt-4">
        <div class="row">
            {{-- LEFT COLUMN: Business Information --}}
            <div class="col-md-5 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-building me-2"></i>Business Information</h5>
                    </div>
                    <div class="card-body">
                        {{-- Business Image --}}
                        @if ($picture)
                            <img src="{{ asset('storage/' . $picture) }}" 
                                 alt="{{ $business_name }}" 
                                 class="img-fluid rounded mb-3"
                                 style="width: 100%; height: 200px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/No-Image.png') }}" 
                                 alt="Default" 
                                 class="img-fluid rounded mb-3"
                                 style="width: 100%; height: 200px; object-fit: contain;">
                        @endif

                        <h4 class="fw-bold text-dark">{{ $business_name }}</h4>
                        <p class="text-muted mb-2"><i class="bi bi-geo-alt-fill text-primary"></i> {{ $business_address }}</p>
                        <p class="mb-2"><strong>Email:</strong> {{ $email }}</p>
                        <p class="mb-2"><strong>Contact:</strong> {{ $contact_number }}</p>
                        <p class="mb-2"><strong>Permit:</strong> {{ $business_permit }}</p>
                        <p class="mb-2"><strong>Expiration:</strong> {{ $expiration_date }}</p>

                        {{-- Ratings --}}
                        <div class="mt-3">
                            @php
                                $rating = 4.5; // Example rating
                                $stars = floor($rating);
                                $half = $rating - $stars >= 0.5;
                            @endphp
                            @for ($i = 0; $i < $stars; $i++)
                                <i class="bi bi-star-fill text-warning"></i>
                            @endfor
                            @if ($half)
                                <i class="bi bi-star-half text-warning"></i>
                            @endif
                            @for ($i = $stars + ($half ? 1 : 0); $i < 5; $i++)
                                <i class="bi bi-star text-warning"></i>
                            @endfor
                            <span class="ms-2 text-muted small">({{ number_format($rating, 1) }})</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN: Services Offered --}}
            <div class="col-md-7">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-list-ul me-2"></i>Services Offered
            </h5>
        </div>

        <div class="card-body">
            <div class="row g-3">
                @forelse ($services as $service)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="card shadow-sm border-0 h-100 text-center p-2">
                            @if ($service->picture)
                                <img src="{{ asset('storage/' . $service->picture) }}" 
                                    alt="{{ $service->name_service }}"
                                    class="rounded mb-2"
                                    style="width: 100%; height: 100px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/No-Image.png') }}" 
                                    alt="Default"
                                    class="rounded mb-2"
                                    style="width: 100%; height: 100px; object-fit: cover;">
                            @endif

                            <div>
                                <h6 class="fw-semibold mb-1 text-truncate" title="{{ $service->name_service }}">
                                    {{ $service->name_service }}
                                </h6>
                                <p class="text-muted small mb-1">{{ $service->type_service }}</p>
                                <p class="fw-bold text-primary small mb-2">₱{{ number_format($service->price, 2) }}</p>

                                @if ($service->staff->count() > 0)
                                    <div class="text-center mb-2">
                                        @foreach ($service->staff as $staff)
                                            <p class="small text-muted mb-0">{{ $staff->full_name }}</p>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted small mb-2">No staff assigned</p>
                                @endif

                                <!-- Reserve Button -->
                                <button 
                                    class="btn btn-sm btn-success w-100"
                                    wire:click="openReservationModal({{ $service->id }})"
                                    data-bs-toggle="modal"
                                    data-bs-target="#checkoutmodal">
                                    <i class="bi bi-calendar-check me-1"></i> Reserve
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="alert alert-light shadow-sm mb-0" style="color:black">No services available.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
    @include('livewire.customer.modal.checkout')
    @push('scripts')
    <script data-navigate-once>
        document.addEventListener('livewire:navigated', () => {

            Livewire.on('showCheckoutModal', (event) => {
                $('#checkoutmodal').modal('show');
            });

            Livewire.on('closeCheckoutModal', (event) => {
                $('#checkoutmodal').modal('hide');
            });

        });

        

    </script>
    @endpush
</div>
