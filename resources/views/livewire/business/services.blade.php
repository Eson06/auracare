<div>
    @section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Services')

    <ol class="breadcrumb fs-3" aria-label="breadcrumbs">
        <li class="breadcrumb-item active text-muted" aria-current="page">Services</a></li>
    </ol>


<div class="container my-4">

  <!-- Row 1: Staff -->
  <div class="row mb-3">
    <div class="col-md-12">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
          <h5 class="mb-0">Staff</h5>
          <button class="btn btn-light btn-sm text-primary" data-bs-toggle="modal" data-bs-target="#addstaffmodal">
            <i class="fas fa-plus"></i> Add Staff
          </button>
        </div>
        <div class="card-body">
          <div class="row">
    @forelse ($staffs as $staff)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm text-center p-2">
                @if ($staff->picture)
                    <img src="{{ asset('storage/' . $staff->picture) }}"
                         class="rounded-circle mx-auto d-block mt-2"
                         width="70" height="70"
                         style="object-fit: cover;">
                @else
                    <img src="{{ asset('images/default-avatar.png') }}"
                         class="rounded-circle mx-auto d-block mt-2"
                         width="70" height="70">
                @endif

                <div class="card-body p-2">
                    <h6 class="card-title mb-1 text-truncate">{{ $staff->full_name }}</h6>
                    <p class="text-muted mb-0" style="font-size: 0.85rem;">{{ $staff->gender }}</p>
                    <p class="text-muted mb-0" style="font-size: 0.8rem;">
                        {{ \Carbon\Carbon::parse($staff->birthday)->age }} yrs old
                    </p>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-light text-center py-2 mb-0" style="color:black">
                No staff members added yet.
            </div>
        </div>
    @endforelse
</div>

        </div>
      </div>
    </div>
  </div>

  <!-- Row 2: Services -->
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-success text-white">
          <h5 class="mb-0">Services</h5>
          <button class="btn btn-light btn-sm text-success" data-bs-toggle="modal" data-bs-target="#addservicesmodal">
            <i class="fas fa-plus"></i> Add Service
          </button>
        </div>
        <div class="card-body">
          <div class="container py-3">

    <div class="row g-3">
        @forelse ($services as $service)
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
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
                            <div class="text-center">
                                @foreach ($service->staff as $staff)
                                    <p class="small text-muted mb-0">{{ $staff->full_name }}</p>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted small mb-0">No staff assigned</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center" >
                <div class="alert alert-light shadow-sm mb-0" style="color:black">No services added yet.</div>
            </div>
        @endforelse
    </div>
</div>

        </div>
      </div>
    </div>
  </div>

</div>

    @include('livewire.business.modal.add-staff')
    @include('livewire.business.modal.add-services')
</div>
