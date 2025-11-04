<div>
    @section ('pageTitle',isset($pageTitle) ? $pageTitle : 'Review and Rating')

    <ol class="breadcrumb fs-3" aria-label="breadcrumbs">
        <li class="breadcrumb-item active text-muted" aria-current="page">Review and Rating</a></li>
    </ol>

    <div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Ratings and Review</h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Service Name</th>
                            <th>Type</th>
                            <th>Customer Name</th>
                            <th>Comment</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orderdetails as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $order->name_service }}</td>
                                <td>{{ $order->type_service }}</td>
                                <td>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</td>
                                <td>{{ $order->comment }}</td>
                                <td>{{ $order->ratings }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted py-3">
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