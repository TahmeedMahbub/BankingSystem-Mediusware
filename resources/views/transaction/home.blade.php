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
        <th scope="col">Amount</th>
        <th scope="col">Fee</th>
        <th scope="col">Date</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>
            <span class="badge bg-success">Deposit</span>
        </td>
        <td>Otto</td>
        <td>Otto</td>
        <td>Otto</td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>
            <span class="badge bg-danger">Withdraw</span>
        </td>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>Thornton</td>
      </tr>
    </tbody>
  </table>
@endsection
