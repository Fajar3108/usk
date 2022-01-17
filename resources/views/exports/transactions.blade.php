<table>
    <thead>
        <tr>
            <th>Code</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Confirmed By</th>
            <th>Sender</th>
            <th>Receiver</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
        <tr>
            <td>{{ $transaction->code }}</td>
            <td>{{ $transaction->type_name }}</td>
            <td>{{ CurrencyHelper::rupiah($transaction->amount) }}</td>
            <td>{{ $transaction->confirm_by->name ?? '' }}</td>
            <td>{{ $transaction->sender->name ?? '' }}</td>
            <td>{{ $transaction->receiver->name ?? '' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
