
@extends('layout.adminApp')

@section('content')

<!-- layout start -->

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Admin Dashboard | Pizza Haven</h3>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Bill History</div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Bill Id</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Pizza</th>
                                        <th scope="col" class="text-end">Total</th>
                                        <th scope="col" class="text-end">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($deactiveBills as $bill)


                                        <tr>
                                            <td >{{ $bill->id }}</td>
                                            <td >{{ $bill->user->email}}</td>
                                            <td>
                                                @foreach($bill->orders as $order)
                                                    {{ $order->name }} x{{ $order->qty }} <br>
                                                @endforeach
                                            </td>
                                            <td class="text-end">${{ $bill->total_price }}</td>
                                            <td class="text-end">{{ $bill->updated_at }}</td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- layout end -->

@endsection
