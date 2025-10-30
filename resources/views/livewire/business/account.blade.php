<div>
    @section ('pageTitle', isset($pageTitle) ? $pageTitle : 'Account')

    <ol class="breadcrumb fs-3" aria-label="breadcrumbs">
        <li class="breadcrumb-item active text-muted" aria-current="page">Account</li>
    </ol>

<div class="card shadow border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Payment Details</h5>
        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#accountmodal">
            <i class="fas fa-plus me-1"></i> Add Payment
        </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Account Type</th>
                        <th>Account Name</th>
                        <th>Account Number</th>
                        <th>QR Code</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($paymentDetails as $index => $payment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <span class="badge 
                                    @if($payment->type_account == 'GCash') bg-info 
                                    @elseif($payment->type_account == 'Maya') bg-success 
                                    @else bg-secondary @endif">
                                    {{ $payment->type_account }}
                                </span>
                            </td>
                            <td>{{ $payment->name }}</td>
                            <td>{{ $payment->number }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $payment->qr) }}" 
                                     alt="QR" class="img-thumbnail" width="70">
                            </td>

                    @empty
                        <tr>
                            <td colspan="6" class="text-muted py-4">No payment records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

      @include('livewire.business.modal.account')
</div>
