@extends('layout.app')

@section('content')

<html>

<div class="breadcrumb-area breadcrumb-padding-6">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <div class="breadcrumb-title">
                <h2>Cart</h2>
            </div>
            <ul>
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
                <li>CART</li>
            </ul>
        </div>
    </div>
</div>

<div class="cart-area pb-130">
    <div class="container">
        <div class="row pb-120">
            <div class="col-12">
                <form method="POST" action="{{ route('update.cart') }}">
                    @csrf
                    <div class="cart-table-content">
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="width-thumbnail"></th>
                                        <th class="width-name">Pizza</th>
                                        <th class="width-price"> Price</th>
                                        <th class="width-quantity">Quantity</th>
                                        <th class="width-subtotal">Subtotal</th>
                                        <th class="width-remove"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pizzaOrder as $pizza)

                                        <tr>
                                            <td class="product-thumbnail">
                                                <img src="{{ asset('assets/images/cart/pizza_kecik.jpg') }}" alt="">
                                            </td>
                                            <td class="product-name">
                                                <h5>{{ $pizza->name }}</h5>
                                            </td>
                                            <td class="product-price"><span class="amount">RM15</span></td>
                                            <td class="cart-quality">
                                                <div class="product-quality">
                                                    <input class="cart-plus-minus-box input-text qty text" name="quantity" value="{{ $pizza->qty }}" type="number" min="0">
                                                </div>
                                            </td>
                                            <td class="product-total"><span>RM {{ $pizza->price }}</span></td>
                                            <td class="product-remove">
                                                <a href="#" onclick="removeProduct(0)"><i class="las la-trash"></i></a>
                                            </td>
                                        </tr>

                                    @endforeach

                                        
                                    
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <a href="{{ route('order') }}">Order More Pizza</a>
                                </div>
                                <div class="cart-clear">
                                    <button type="submit">Update Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-4 col-md-6 col-12">
                <div class="grand-total-wrap ">
                    <div class="grand-total-btn">
                        <a class="btn btn-link" href="{{ route('checkout') }}">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function removeProduct(index) {
        // Set the value of the corresponding quantity input field to 0
        // document.querySelector('input[name="quantity' + index + '"]').value = 0;
        document.querySelector('input[name="quantity"]').value = 0;
    }
</script>


</html>

@endsection
