<div>
    @section('pageTitle', isset($pageTitle) ? $pageTitle : 'Booking')

    <ol class="breadcrumb fs-3" aria-label="breadcrumbs">
        <li class="breadcrumb-item active text-muted" aria-current="page">Booking</li>
    </ol>

    <div class="container py-5">
        <h2 class="text-center text-info mb-5">Registered Salon & Spa Businesses</h2>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse ($businesses as $business)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img 
                            src="{{ $business->picture ? asset('storage/' . $business->picture) : asset('images/No-Image.png') }}" 
                            class="card-img-top p-3 rounded-circle mx-auto" 
                            style="width: 100px; height: 100px; object-fit: cover;" 
                            alt="Logo">

                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $business->business_name }}</h5>
                            <p class="card-text">{{ $business->business_address }}</p>

                            {{-- Optional: Display permit status or expiration --}}
                            <p class="text-muted small mb-1">
                                Permit expires: {{ \Carbon\Carbon::parse($business->expiration_date)->format('M d, Y') }}
                            </p>

                            {{-- Optional: Display status badge --}}
                            @if ($business->status)
                                <span class="badge 
                                    @if($business->status == 'approved') bg-success 
                                    @elseif($business->status == 'pending') bg-warning 
                                    @else bg-secondary @endif">
                                    {{ ucfirst($business->status) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted fs-5">No registered businesses found.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
