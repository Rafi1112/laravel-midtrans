@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container px-4 py-5" id="custom-cards">

            <div id="notification-realtime"></div>
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <h2 class="pb-2 border-bottom">Your Billings</h2>
            <br>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Order Date : {{ $order->created_at->format('d F Y, H:i:s') }}</li>
                <li class="list-group-item">User Email : {{ $order->user->email }}</li>
                <li class="list-group-item">Invoice : {{ $order->invoice }}</li>
                <li class="list-group-item">Method Payment :</li>
                <li class="list-group-item">
                    Status Payment :
                    @if ($order->status == 'success')
                        <span class="badge badge-success">{{ ucfirst($order->status) }}</span></td>
                    @else
                        <span class="badge badge-danger">{{ ucfirst($order->status) }}</span></td>
                    @endif
                </li>
            </ul>
            <table class="table table-borderless">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item's</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Price</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>{{ $order->gem->title }}</td>
                    <td>1</td>
                    <td>Rp. {{ number_format($order->total, 0, '.', '.') }}</td>
                </tr>
                </tbody>
            </table>
            @if( $order->status == 'pending' )
                <div class="float-right">
                    <button type="button" id="pay-button" data-value="{{ $order->snap_token }}" class="btn btn-primary btn-block">Pay</button>
                </div>
            @endif
        </div>
    </div>
@endsection

@if( $order->status == 'pending' )
@push('scripts')
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.clientKey') }}">
    </script>
    <script>
        let payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            const snap_token = payButton.getAttribute('data-value');
            snap.pay(snap_token, {
                onSuccess: function(result){
                    console.log(result);
                    document.getElementById('notification-realtime').innerHTML =
                        '<div class="alert alert-success" role="alert"> \n' +
                        'Transaction Success, Please check your balance.' +
                        '</div>';
                    setTimeout(function(){
                        location.reload()
                    }, 3000);
                },
                onPending: function(result){
                    console.log(result);
                    location.reload();
                },
                onError: function(result){
                    console.log(result);
                    location.reload();
                }
            });
            return false;
        })
    </script>
@endpush
@endif
