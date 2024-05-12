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
                            <input type="number" class="form-control" id="amount" name="amount" min="0" max="{{ Auth::user()->balance }}" step="0.01" value="{{ old('amount') }}" required>
                        </div>
                        <div id="fee" class="mb-3 mt-1"><b>Fee: </b>0 Taka</div>

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

@section('footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#amount').on('input', function() {
                var amountValue = $(this).val() == null ? 0 : $(this).val();

                if ($(this).val()) {
                    var amountValue = $(this).val();
                }
                else {
                    var amountValue = 0;
                }

                $.ajax({
                    url: '/withdraw/fee/' + amountValue,
                    type: 'GET',
                    success: function(fee) {
                        var fee = `<b>Fee: </b>${fee} Taka`;
                        $("#fee").html(fee);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

@endsection
