<div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

    <table id="data-table" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
        <thead>
        <tr>
            <th data-priority="0">ID</th>
            <th data-priority="1">User</th>
            <th data-priority="2">Payment Gateway</th>
            <th data-priority="3">Shipped</th>
            <th data-priority="4">Error</th>
            <th data-priority="5">Placed At</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

        @foreach($orders as $order)

            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->payment_gateway }}</td>
                <td>{{ $order->shipped ? 'Yes' : 'Not' }}</td>
                <td>{{ $order->error ?? 'None' }}</td>
                <td>{{ $order->created_at }}</td>
            </tr>

        @endforeach

        </tbody>
    </table>
</div>
