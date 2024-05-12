@extends('welcome')
@section('main')

<div class="d-flex justify-content-between">
    <div><b>Balance: </b>{{ number_format( Auth::user()->balance , 2) }} BDT</div>
    <div>
        <a href="{{ route('withdraw.create') }}" class="btn btn-info">Add Withdraw</a>
    </div>
</div>

<center><h2>Withdraw List</h2></center>
<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th class="text-right" scope="col">Amount</th>
            <th class="text-right" scope="col">Fee</th>
            <th class="text-right" scope="col">Total</th>
            <th class="text-right" scope="col">Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($withdraws as $withdraw)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td class="text-right">{{ $withdraw->amount }}</td>
            <td class="text-right">{{ $withdraw->fee }}</td>
            <td class="text-right">{{ number_format(($withdraw->amount + $withdraw->fee), 2) }}</td>
            <td class="text-right">{{ date('d-M-Y', strtotime($withdraw->date)) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
