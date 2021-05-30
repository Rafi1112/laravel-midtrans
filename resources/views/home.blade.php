@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">TopUp History</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Items</th>
                            <th scope="col">Bill</th>
                            <th scope="col">Status</th>
                            <th scope="col">Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <th scope="row">#</th>
                                <td>{{ $order->invoice }}</td>
                                <td>{{ $order->gem->title }}</td>
                                <td>Rp. {{ number_format($order->total, 0, '.', '.') }}</td>
                                <td>
                                    @if ($order->status == 'success')
                                        <span class="badge badge-success">{{ ucfirst($order->status) }}</span></td>
                                    @else
                                        <span class="badge badge-danger">{{ ucfirst($order->status) }}</span></td>
                                    @endif
                                <td>
                                    <a href="{{ route('invoice', $order->invoice) }}">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
