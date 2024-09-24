
@extends('layout.adminApp')

@section('content')

<!-- layout start -->

<script>
    // Wait for the DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Retrieve flash message from the session
        @if(session('success'))
            alert('{{ session('success') }}');
        @endif

        // Check if there is a flash message in the session and display it in an alert
        @if(session('error'))
            alert('{{ session('error') }}');
        @endif
    });
</script>


<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                @if(Auth::user()->user_type == 1)
                    <h3 class="fw-bold mb-3">Staff Dashboard | Pizza Haven</h3>
                @elseif(Auth::user()->user_type == 0)
                    <h3 class="fw-bold mb-3">Admin Dashboard | Pizza Haven</h3>
                @endif
            </div>
        </div>

        @can('view-admin-detail')
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Staff</p>
                                    <h4 class="card-title">{{ $staffCount ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Customer</p>
                                    <h4 class="card-title">{{ $cutomerCount ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-luggage-cart"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Sales</p>
                                    <h4 class="card-title">$ {{ $totalPayment ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="far fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Order</p>
                                    <h4 class="card-title">{{ $billCount ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
        
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Pizza Orders</div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="text-end">Id</th>
                                        <th scope="col">Pizza</th>
                                        <th scope="col" class="text-end">Total</th>
                                        <th scope="col" class="text-end">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($activeBills as $bill)

                                        @php
                                            $pizzaStatus = '';
                                            if ($bill->status == 0) {
                                                $pizzaStatus = "Start cooking";
                                            } elseif ($bill->status == 1) {
                                                $pizzaStatus = "Deliver";
                                            } elseif ($bill->status == 2) {
                                                $pizzaStatus = "Delivered";
                                            }else{
                                                $pizzaStatus = "Lebih";
                                            }
                                        @endphp

                                        <tr>
                                            <td class="text-end">{{ $bill->id }}</td>
                                            <td>
                                                @foreach($bill->orders as $order)
                                                    {{ $order->name }} x{{ $order->qty }} <br>
                                                @endforeach
                                            </td>
                                            <td class="text-end">${{ $bill->total_price }}</td>
                                            <td class="text-end">
                                                @if($bill->status == 0 || $bill->status == 1)
                                                    <!-- Show form with submit button for status 0 or 1 -->
                                                    <form action="{{ route('update.status', $bill->id) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="1"> <!-- Increment the status -->
                                                        <button type="submit" class="btn btn-primary btn-round">{{ $pizzaStatus }}</button>
                                                    </form>
                                                @else
                                                    <!-- Show normal button for status 2 -->
                                                    <button class="btn btn-secondary btn-round" disabled>{{ $pizzaStatus }}</button>
                                                @endif
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
    </div>
</div>

<!-- layout end -->

@endsection
