@extends('welcome')
@section('main')

<div class="d-flex justify-content-between">
    <div><b>Balance: </b>{{ number_format( Auth::user()->balance , 2) }} BDT</div>
    <div>
        <a href="{{ route('deposit.create') }}" class="btn btn-info">Add Deposit</a>
    </div>
</div>

<center><h2>Deposit List</h2></center>
<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Amount</th>
            <th scope="col">Fee</th>
            <th scope="col">Date</th>
        </tr>
    </thead>
    <tbody>
        @if(count($deposits) > 0)
            @foreach($deposits as $deposit)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $deposit->amount }}</td>
                <td>{{ $deposit->fee }}</td>
                <td>{{ date('d-M-Y', strtotime($deposit->date)) }}</td>
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
