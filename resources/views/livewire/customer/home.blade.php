<div>
    @section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Home')

    <ol class="breadcrumb fs-3" aria-label="breadcrumbs">
        <li class="breadcrumb-item active text-muted" aria-current="page">Home</a></li>
    </ol>

<div class="container py-4">
<div class="row g-3">
 <div class="row g-3">
  @forelse($businesses as $business)
    <div class="col-6 col-md-4 col-lg-3">
      <div class="card shadow-sm border-0 h-100" style="font-size: 0.9rem;">
        
        {{-- Business Image --}}
        @if ($business->picture)
          <img src="{{ asset('storage/' . $business->picture) }}" 
               alt="{{ $business->business_name }}"
               class="rounded-top"
               style="width: 100%; height: 80px; object-fit: cover;">
        @else
          <img src="{{ asset('images/No-Image.png') }}" 
               alt="Default"
               class="rounded-top"
               style="width: 100%; height: 80px; object-fit: contain; background-color: #f8f9fa;">
        @endif

        {{-- Card Body --}}
        <div class="card-body p-2 d-flex flex-column">
          <h6 class="card-title fw-semibold text-dark mb-1 text-truncate">
            {{ $business->business_name }}
          </h6>
          <p class="text-muted small mb-1">
            <span class="text-truncate d-inline-block" style="max-width: 100%;">
              {{ $business->business_address }}
            </span>
          </p>

          {{-- ⭐ Star Ratings --}}
          @php
              $rating = $business->rating ?? 4.3; // Example rating, replace with your DB field
              $stars = floor($rating);
              $half = ($rating - $stars) >= 0.5;
          @endphp
          <div class="mb-2">
            @for ($i = 0; $i < $stars; $i++)
              <i class="bi bi-star-fill text-warning small"></i>
            @endfor
            @if ($half)
              <i class="bi bi-star-half text-warning small"></i>
            @endif
            @for ($i = $stars + ($half ? 1 : 0); $i < 5; $i++)
              <i class="bi bi-star text-warning small"></i>
            @endfor
            <span class="text-muted small ms-1">({{ number_format($rating, 1) }})</span>
          </div>

          {{-- View Services Button --}}
          <a href="{{ route('customer.shop', $business->id) }}" 
            class="btn btn-sm btn-outline-primary mt-auto w-100">
              <i class="bi bi-eye-fill me-1"></i> View Services
          </a>
        </div>
      </div>
    </div>
  @empty
    <div class="col-12 text-center py-5">
      <div class="card border-0 bg-light">
        <div class="card-body">
          <i class="bi bi-shop-window display-4 text-muted mb-3"></i>
          <h5 class="text-muted">No shops available</h5>
          <p class="small text-secondary mb-0">Please check back later</p>
        </div>
      </div>
    </div>
  @endforelse
</div>

</div>


</div>


</div>
