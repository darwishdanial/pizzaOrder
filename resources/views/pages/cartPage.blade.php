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
                <form id="update-cart-form" method="POST" action="{{ route('update.cart') }}">
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

                                        <tr id="product-row-{{ $pizza->id }}">
                                            <td class="product-thumbnail">
                                                <img src="{{ asset('assets/images/cart/pizza_kecik.jpg') }}" alt="">
                                            </td>
                                            <td class="product-name">
                                                <h5>{{ $pizza->name }}</h5>
                                            </td>
                                            <td class="product-price"><span id="product-price-{{ $pizza->id }}">RM {{ $pizza->price / $pizza->qty }}</span></td>
                                            <td class="cart-quality">
                                                <div class="product-quality">
                                                    <!-- <input class="cart-plus-minus-box input-text qty text" name="quantity[{{ $pizza->id }}]" value="{{ $pizza->qty }}" type="number" min="0"> -->
                                                    <input id="quantity-input-{{ $pizza->id }}" class="cart-plus-minus-box input-text qty text" name="quantity[{{ $pizza->id }}]" value="{{ $pizza->qty }}" type="number" min="0">
                                                </div>
                                            </td>
                                            <td class="product-total"><span id="product-total-{{ $pizza->id }}">RM {{ $pizza->price }}</span></td>
                                            <td class="product-remove">
                                                <a href="#" class="remove-product" data-id="{{ $pizza->id }}"><i class="las la-trash"></i></a>
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
                                    <a href="{{ route('order', ['user' => Auth::user()->id ?? 'guest']) }}">Order More Pizza</a>
                                </div>
                                <div class="cart-clear">
                                    <button type="submit" id="update-cart-button">Update Cart</button>
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
                        <a class="btn btn-link" href="{{ route('checkout', ['user' => Auth::user()->id ?? 'guest']) }}">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // function removeProduct(index) {
    //     // Set the value of the corresponding quantity input field to 0
    //     // document.querySelector('input[name="quantity' + index + '"]').value = 0;
    //     document.querySelector('input[name="quantity[' + index + ']"]').value = 0;
    // }
    $(document).ready(function() {
        $('#update-cart-form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '{{ route("update.cart") }}',
                data: $(this).serialize(),      //to send normal form submission
                success: function(response) {
                    // alert(response.message);

                    response.orders.forEach(function(order) {
                        const pricePerUnit = (order.price / order.qty);
                        $('#product-price-' + order.id).text('RM ' + pricePerUnit);
                        $('#product-total-' + order.id).text('RM ' + order.price);
                        $('#quantity-input-' + order.id).val(order.qty);
                });
                $('#total-price').text('RM ' + response.totalPrice);
                },
                error: function(response) {
                    alert('An error occurred while updating the cart.');
                }
            });
        });

        $('.remove-product').on('click', function(e) {
            e.preventDefault();
            const productId = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: '{{ route("update.cart") }}',
                data: {                   //to send custom data
                    _token: '{{ csrf_token() }}',
                    quantity: {
                        [productId]: 0
                    }
                },
                success: function(response) {
                    // alert('Product removed successfully!');
                    $('#product-row-' + productId).remove();
                    // Optionally, update the page content based on the response
                },
                error: function(response) {
                    alert('An error occurred while removing the product.');
                }
            });
        });
    });

</script>


</html>

@endsection
