<table>
    <thead>
        <tr>
            <th>Sl</th>
            <th>Customer</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Amount</th>
            <th>Payment</th>
            <th>Pay Status</th>
            <th>Create</th>
        </tr>
    </thead>
    <tbody>
        @foreach($billings as $item)
            <tr>
                <td>{{ $loop->index +1 }}</td>
                <td>{{ $item->fullName }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->email ?? 'N/A' }}</td>
                <td>{{ $item->total_amount ?? 'unpaid' }}</td>
                <td>{{ $item->paymentMethod }}</td>
                <td>
                    @if ($item->paymentStatus == 1)
                        panding
                    @else
                        paid
                    @endif
                </td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
