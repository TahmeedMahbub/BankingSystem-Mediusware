@extends('welcome')
@section('main')

<div class="d-flex justify-content-between">
    <div><b>Date: </b>{{ date('d-M-Y') }}</div>
    <div>
        <a href="{{ route('withdraw.create') }}" class="btn btn-outline-info">← Back To Withdraw List</a>
    </div>
</div>

<center><h2>Withdraw Create</h2></center>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Withdraw</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('withdraw.store') }}">
                        @csrf


                        <div class="form-group">
                            <label for="amount">Withdrawn Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" min="0" step="0.01" value="{{ old('amount') }}" required>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div>
                            <button type="submit" class="btn btn-primary">Withdraw</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
