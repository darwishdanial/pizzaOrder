@extends('layout.app')

@section('content')

<html>

<div class="breadcrumb-area breadcrumb-padding-6">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <div class="breadcrumb-title">
                <h2>Bill History</h2>
            </div>
            <!-- <ul>
                <li>
                    <a href="{{ route('firstPage') }}">HOME</a>
                </li>
                <li>
                    >
                </li>
                <li><a href="{{ route('order') }}">ORDER PIZZA</a></li>
                <li>
                    >
                </li>
                <li><a href="{{ route('cart', ['user' => Auth::user()->id ?? 'guest']) }}">CART</a></li>
                <li>
                    >
                </li>
                <li><a href="{{ route('checkout', ['user' => Auth::user()->id ?? 'guest']) }}">CHECKOUT</a></li>
                <li>
                    >
                </li>
                <li> DELIVERY </li>
            </ul> -->
        </div>
    </div>
</div>

@if ($emptyBillHistory == "yes")
<div class="checkout-main-area pb-130">
    <div class="container">
                <div class="col-lg-5">
                    <div class="your-order-area">
                        <h3>No orders. Continue ordering</h3>   
                        <div class="Place-order">
                            <a href="{{ route('firstPage') }}">Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
@foreach ($deactiveBills as $bill)
<div class="checkout-main-area pb-130">
    <div class="container">
                <div class="col-lg-5">
                    <div class="your-order-area">
                        <h3>Bill id: {{$bill->id}}</h3>
                        <div class="your-order-wrap gray-bg-4">
                            <div class="your-order-info-wrap">
                                <div class="your-order-info">
                                    <ul>
                                        <li>PIZZA <span>Total</span></li>
                                    </ul>
                                </div>
                                <div class="your-order-middle">

                                    <ul>
                                        @foreach ($bill->orders as $pizza)
                                            @if ($pizza->qty > 0)
                                                <li>{{ $pizza->name }} X{{ $pizza->qty }} <span>RM{{ $pizza->price }}</span></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="your-order-info order-subtotal">
                                    <ul>
                                        <li>Subtotal <span>RM{{$bill->total_price}} </span></li>
                                    </ul>
                                </div>
                                <div class="your-order-info order-shipping">
                                    <ul>
                                        <li>Delivery <p>RM5</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="your-order-info order-total">
                                    <ul>
                                        <li>Total <span>RM{{$bill->total_price + 5}} </span></li>
                                    </ul>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif
</html>

@endsection