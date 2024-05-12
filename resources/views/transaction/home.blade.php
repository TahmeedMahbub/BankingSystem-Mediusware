@extends('welcome')
@section('main')

<div class="d-flex justify-content-between">
    <div><b>Balance: </b>{{ number_format( Auth::user()->balance , 2) }} BDT</div>
    <div><b>Date: </b>{{ date('d-M-Y') }}</div>
</div>

<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Type</th>
            <th class="text-right" scope="col">Amount</th>
            <th class="text-right" scope="col">Fee</th>
            <th class="text-right" scope="col">Fee</th>
            <th class="text-right" scope="col">Date</th>
        </tr>
    </thead>
    <tbody>
        @if(count($transactions) > 0)
            @foreach($transactions as $transaction)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        <span class="badge bg-{{ $transaction->transaction_type == "deposit" ? "success" : "danger" }}">{{ ucfirst($transaction->transaction_type) }}</span>
                    </td>
                    <td class="text-right">{{ $transaction->amount }}</td>
                    <td class="text-right">{{ $transaction->fee }}</td>
                    <td class="text-right">{{ $transaction->amount + $transaction->fee }}</td>
                    <td class="text-right">{{ date('d-M-Y', strtotime($transaction->date)) }}</td>
                </tr>
            @endforeach
        @else
        <tr>
            <td colspan="6" class="text-center">No Data Found!</td>
        </tr>
        @endif

    </tbody>
</table>
@endsection
