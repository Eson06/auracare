<div>
    @section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Booking')

    <ol class="breadcrumb fs-3" aria-label="breadcrumbs">
        <li class="breadcrumb-item active text-muted" aria-current="page">Booking</a></li>
    </ol>

    <div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Order Details</h5>
        </div>

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
                            <th>Customer Name</th>
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
                                <td>{{ $order->customer->first_name  }}  {{ $order->customer->last_name  }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-3">
                                    No order details found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


</div>
