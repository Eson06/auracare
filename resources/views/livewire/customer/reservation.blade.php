<div>
    @section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Reservation')

    <ol class="breadcrumb fs-3" aria-label="breadcrumbs">
        <li class="breadcrumb-item active text-muted" aria-current="page">Reservation</a></li>
    </ol>

    <div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Service Name</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Date Schedule</th>
                    <th>Time</th>
                    <th>Picture</th>
                    <th>Amount Paid</th>
                    <th>Balance</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orderdetails as $index => $order)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $order->name_service }}</td>
                        <td>{{ $order->type_service }}</td>
                        <td>₱{{ number_format($order->price, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->date_schdedule)->format('M d, Y') }}</td>
                        <td>{{ $order->selected_time }}</td>
                        <td>
                            @if ($order->picture)
                                <img src="{{ asset('storage/' . $order->picture) }}" alt="Service Picture" width="50" height="50" class="rounded">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td>₱{{ number_format($order->amount_paid, 2) }}</td>
                        <td>
                            @php $balance = $order->price - $order->amount_paid; @endphp
                            @if ($balance <= 0)
                                <span class="text-success">Fully Paid</span>
                            @else
                                ₱{{ number_format($balance, 2) }}
                            @endif
                        </td>
                        <td>
                            @if ($order->status === 'completed')
                                <span class="badge bg-success">Completed</span>
                            @elseif ($order->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($order->status === 'pending')
                                <button class="btn btn-sm btn-primary" disabled>
                                    Rate
                                </button>
                            @elseif ($order->status === 'completed' && !$order->ratings)
                                <button wire:click="openRatingModal({{ $order->id }})" class="btn btn-sm btn-primary">
                                    Rate
                                </button>
                            @elseif ($order->ratings)
                                <div class="text-warning">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $order->ratings)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star text-secondary"></i>
                                        @endif
                                    @endfor
                                </div>
                            @endif
                        </td>
                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted py-3">
                            No order details found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


@include('livewire.customer.modal.rate')
@push('scripts')
<script data-navigate-once>
    document.addEventListener('livewire:navigated', () => {

        Livewire.on('showRateModal', (event) => {
            $('#ratemodal').modal('show');
        });

        Livewire.on('closeRateModal', (event) => {
            $('#ratemodal').modal('hide');
        });

    });

    

</script>
@endpush
</div>
