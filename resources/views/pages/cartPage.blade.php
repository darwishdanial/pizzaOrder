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
                                        
                                    @if ($pizzaQty[0] !== 0)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <img src="{{ asset('assets/images/cart/pizza_kecik.jpg') }}" alt="">
                                            </td>
                                            <td class="product-name">
                                                <h5>{{ $pizzaName[0] }}</h5>
                                            </td>
                                            <td class="product-price"><span class="amount">RM15</span></td>
                                            <td class="cart-quality">
                                                <div class="product-quality">
                                                    <input class="cart-plus-minus-box input-text qty text" name="quantity0" value="{{ $pizzaQty[0] }}" type="number" min="0">
                                                </div>
                                            </td>
                                            <td class="product-total"><span>RM {{ $pizzaQty[0] * 15 }}</span></td>
                                            <td class="product-remove">
                                                <a href="#" onclick="removeProduct(0)"><i class="las la-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($pizzaQty[1] !== 0)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <img src="{{ asset('assets/images/cart/pizza_kecik.jpg') }}" alt="">
                                            </td>
                                            <td class="product-name">
                                                <h5>{{ $pizzaName[1] }}</h5>
                                            </td>
                                            <td class="product-price"><span class="amount">RM21</span></td>
                                            <td class="cart-quality">
                                                <div class="product-quality">
                                                    <input class="cart-plus-minus-box input-text qty text" name="quantity1" value="{{ $pizzaQty[1] }}" type="number" min="0">
                                                </div>
                                            </td>
                                            <td class="product-total"><span>RM {{ $pizzaQty[1] * 21 }}</span></td>
                                            <td class="product-remove">
                                                <a href="#" onclick="removeProduct(1)"><i class="las la-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($pizzaQty[2] !== 0)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <img src="{{ asset('assets/images/cart/pizza_kecik.jpg') }}" alt="">
                                            </td>
                                            <td class="product-name">
                                                <h5>{{ $pizzaName[2] }}</h5>
                                            </td>
                                            <td class="product-price"><span class="amount">RM18</span></td>
                                            <td class="cart-quality">
                                                <div class="product-quality">
                                                    <input class="cart-plus-minus-box input-text qty text" name="quantity2" value="{{ $pizzaQty[2] }}" type="number" min="0">
                                                </div>
                                            </td>
                                            <td class="product-total"><span>RM {{ $pizzaQty[2] * 18 }}</span></td>
                                            <td class="product-remove">
                                                <a href="#" onclick="removeProduct(2)"><i class="las la-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($pizzaQty[3] !== 0)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <img src="{{ asset('assets/images/cart/pizza_kecik.jpg') }}" alt="">
                                            </td>
                                            <td class="product-name">
                                                <h5>{{ $pizzaName[3] }}</h5>
                                            </td>
                                            <td class="product-price"><span class="amount">RM24</span></td>
                                            <td class="cart-quality">
                                                <div class="product-quality">
                                                    <input class="cart-plus-minus-box input-text qty text" name="quantity3" value="{{ $pizzaQty[3] }}" type="number" min="0">
                                                </div>
                                            </td>
                                            <td class="product-total"><span>RM {{ $pizzaQty[3] * 24 }}</span></td>
                                            <td class="product-remove">
                                                <a href="#" onclick="removeProduct(3)"><i class="las la-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($pizzaQty[4] !== 0)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <img src="{{ asset('assets/images/cart/pizza_kecik.jpg') }}" alt="">
                                            </td>
                                            <td class="product-name">
                                                <h5>{{ $pizzaName[4] }}</h5>
                                            </td>
                                            <td class="product-price"><span class="amount">RM22</span></td>
                                            <td class="cart-quality">
                                                <div class="product-quality">
                                                    <input class="cart-plus-minus-box input-text qty text" name="quantity4" value="{{ $pizzaQty[4] }}" type="number" min="0">
                                                </div>
                                            </td>
                                            <td class="product-total"><span>RM {{ $pizzaQty[4] * 22 }}</span></td>
                                            <td class="product-remove">
                                                <a href="#" onclick="removeProduct(4)"><i class="las la-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($pizzaQty[5] !== 0)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <img src="{{ asset('assets/images/cart/pizza_kecik.jpg') }}" alt="">
                                            </td>
                                            <td class="product-name">
                                                <h5>{{ $pizzaName[5] }}</h5>
                                            </td>
                                            <td class="product-price"><span class="amount">RM28</span></td>
                                            <td class="cart-quality">
                                                <div class="product-quality">
                                                    <input class="cart-plus-minus-box input-text qty text" name="quantity5" value="{{ $pizzaQty[5] }}" type="number" min="0">
                                                </div>
                                            </td>
                                            <td class="product-total"><span>RM {{ $pizzaQty[5] * 28 }}</span></td>
                                            <td class="product-remove">
                                                <a href="#" onclick="removeProduct(5)"><i class="las la-trash"></i></a>
                                            </td>
                                        </tr> 
                                    @endif
                                    @if ($pizzaQty[6] !== 0)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <img src="{{ asset('assets/images/cart/pizza_kecik.jpg') }}" alt="">
                                            </td>
                                            <td class="product-name">
                                                <h5>{{ $pizzaName[6] }}</h5>
                                            </td>
                                            <td class="product-price"><span class="amount">RM27</span></td>
                                            <td class="cart-quality">
                                                <div class="product-quality">
                                                    <input class="cart-plus-minus-box input-text qty text" name="quantity6" value="{{ $pizzaQty[6] }}" type="number" min="0">
                                                </div>
                                            </td>
                                            <td class="product-total"><span>RM {{ $pizzaQty[6] * 27 }}</span></td>
                                            <td class="product-remove">
                                                <a href="#" onclick="removeProduct(6)"><i class="las la-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($pizzaQty[7] !== 0)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <img src="{{ asset('assets/images/cart/pizza_kecik.jpg') }}" alt="">
                                            </td>
                                            <td class="product-name">
                                                <h5>{{ $pizzaName[7] }}</h5>
                                            </td>
                                            <td class="product-price"><span class="amount">RM33</span></td>
                                            <td class="cart-quality">
                                                <div class="product-quality">
                                                    <input class="cart-plus-minus-box input-text qty text" name="quantity7" value="{{ $pizzaQty[7] }}" type="number" min="0">
                                                </div>
                                            </td>
                                            <td class="product-total"><span>RM {{ $pizzaQty[7] * 33 }}</span></td>
                                            <td class="product-remove">
                                                <a href="#" onclick="removeProduct(7)"><i class="las la-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($pizzaQty[8] !== 0)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <<img src="{{ asset('assets/images/cart/pizza_kecik.jpg') }}" alt="">
                                            </td>
                                            <td class="product-name">
                                                <h5>{{ $pizzaName[8] }}</h5>
                                            </td>
                                            <td class="product-price"><span class="amount">RM30</span></td>
                                            <td class="cart-quality">
                                                <div class="product-quality">
                                                    <input class="cart-plus-minus-box input-text qty text" name="quantity8" value="{{ $pizzaQty[8] }}" type="number" min="0">
                                                </div>
                                            </td>
                                            <td class="product-total"><span>RM {{ $pizzaQty[8] * 30 }}</span></td>
                                            <td class="product-remove">
                                                <a href="#" onclick="removeProduct(8)"><i class="las la-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($pizzaQty[9] !== 0)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <img src="{{ asset('assets/images/cart/pizza_kecik.jpg') }}" alt="">
                                            </td>
                                            <td class="product-name">
                                                <h5>{{ $pizzaName[9] }}</h5>
                                            </td>
                                            <td class="product-price"><span class="amount">RM36</span></td>
                                            <td class="cart-quality">
                                                <div class="product-quality">
                                                    <input class="cart-plus-minus-box input-text qty text" name="quantity9" value="{{ $pizzaQty[9] }}" type="number" min="0">
                                                </div>
                                            </td>
                                            <td class="product-total"><span>RM {{ $pizzaQty[9] * 36 }}</span></td>
                                            <td class="product-remove">
                                                <a href="#" onclick="removeProduct(9)"><i class="las la-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($pizzaQty[10] !== 0)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <img src="{{ asset('assets/images/cart/pizza_kecik.jpg') }}" alt="">
                                            </td>
                                            <td class="product-name">
                                                <h5>{{ $pizzaName[10] }}</h5>
                                            </td>
                                            <td class="product-price"><span class="amount">RM37</span></td>
                                            <td class="cart-quality">
                                                <div class="product-quality">
                                                    <input class="cart-plus-minus-box input-text qty text" name="quantity10" value="{{ $pizzaQty[10] }}" type="number" min="0">
                                                </div>
                                            </td>
                                            <td class="product-total"><span>RM {{ $pizzaQty[10] * 37 }}</span></td>
                                            <td class="product-remove">
                                                <a href="#" onclick="removeProduct(10)"><i class="las la-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($pizzaQty[11] !== 0)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <img src="{{ asset('assets/images/cart/pizza_kecik.jpg') }}" alt="">
                                            </td>
                                            <td class="product-name">
                                                <h5>{{ $pizzaName[11] }}</h5>
                                            </td>
                                            <td class="product-price"><span class="amount">RM43</span></td>
                                            <td class="cart-quality">
                                                <div class="product-quality">
                                                    <input class="cart-plus-minus-box input-text qty text" name="quantity11" value="{{ $pizzaQty[11] }}" type="number" min="0">
                                                </div>
                                            </td>
                                            <td class="product-total"><span>RM {{ $pizzaQty[11] * 43 }}</span></td>
                                            <td class="product-remove">
                                                <a href="#" onclick="removeProduct(11)"><i class="las la-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endif
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
        document.querySelector('input[name="quantity' + index + '"]').value = 0;
    }
</script>


</html>

@endsection
