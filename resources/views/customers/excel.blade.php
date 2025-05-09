<table>
    <thead>
        <tr>
            <th><b>#</b></th>
            <th><b>Division</b></th>
            <th><b>Customer Number</b></th>
            <th><b>Name</b></th>
            <th><b>Credit Limit</b></th>
            <th><b>Payment Terms</b></th>
            <th><b>KRA Pin</b></th>
            <th><b>Sales Representative</b></th>
            <th><b>Collector</b></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($customers as $customer)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ strtoupper($customer->branch->name) }}</td>
                <td>{{ strtoupper($customer->customer_number) }}</td>
                <td>{{ strtoupper($customer->name) }}</td>
                <td>{{ number_format($customer->credit_limit, 2) }}</td>
                <td>{{ $customer->payment_terms }}</td>
                <td>{{ $customer->kra_pin }}</td>
                <td>{{ strtoupper($customer->salesRepresentative->name) }}</td>
                <td>{{ strtoupper($customer->collector->full_name) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
