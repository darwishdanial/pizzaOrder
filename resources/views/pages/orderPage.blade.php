@extends('layout.app')

@section('content')

<html>

<div class="breadcrumb-area breadcrumb-padding-7">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <div class="breadcrumb-title breadcrumb-title-responsive">
                <h2 data-aos="fade-up" data-aos-delay="200">Order With Pizza Haven</h2>
            </div>
            <ul data-aos="fade-up" data-aos-delay="300">
                <li>
                    <a href="{{ route('firstPage') }}">HOME</a>
                </li>
                <li>
                    >
                </li>
                <li>ORDER PIZZA</li>
            </ul>
        </div>
    </div>
</div>

<div class="product-details-area section-padding-lr-2 pb-115">
    <div class="container-fluid">
        <div class="back-to-shop" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('firstPage') }}"><img class="injectable" src="{{ asset('assets/images/icon-img/arrow-left-6.svg') }}" alt=""> Back to Home</a>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div class="product-details-tab" data-aos="fade-up" data-aos-delay="300">
                    <!-- <div class="pro-dec-big-img-slider"> -->
                        <div class="easyzoom-style">
                            <div class="easyzoom easyzoom--overlay">
                                <a href="{{ asset('assets/images/product/pizza_size.jpg') }}">
                                    <img src="{{ asset('assets/images/product/pizza_size.jpg') }}" alt="">
                                </a>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="product-details-content product-details-mrg-left">
                    <div class="product-rating-stock-review" data-aos="fade-up" data-aos-delay="200">
                        <div class="product-stock">
                            <a href="#"><img src="{{ asset('assets/images/icon-img/check-circle.svg') }}" alt=""></a>
                            <span>In Stock</span>
                        </div>
                    </div>
                    <h2 data-aos="fade-up" data-aos-delay="300">PIZZA</h2>

                    <form id="add-cart-form" method="POST" action="{{ route('add.cart') }}">
                        @csrf

                        <div class="product-details-size clearfix">
                            <select class="nice-select nice-select-style-1" name="size">
                                <option value="" disabled selected>Select Size</option>
                                <option value="Small">Small</option>
                                <option value="Medium">Medium</option>
                                <option value="Large">Large</option>
                            </select>
                        </div>
                        <div class="product-details-size clearfix">
                            <select class="nice-select nice-select-style-1" name="pepperoni">
                                <option value="" disabled selected>Select Pepperoni</option>
                                <option value="Pepperoni">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="product-details-size clearfix">
                            <select class="nice-select nice-select-style-1" name="cheese">
                                <option value="" disabled selected>Select Cheese</option>
                                <option value="Normal Cheese">Normal</option>
                                <option value="Extra Cheese">Extra</option>
                            </select>
                        </div>
                        <div class="product-details-quality-cart" data-aos="fade-up" data-aos-delay="200">
                            <div class="product-quality">
                                <input class="cart-plus-minus-box input-text qty text" name="quantity" value="1" type="number" min="0">
                            </div>
                            <div class="product-details-cart">
                                <button type="submit">Add to cart</button>
                            </div>
                        </div>
                    </form>

                    <div class="product-details-quality-cart" data-aos="fade-up" data-aos-delay="200">
                        <div class="product-details-cart">
                            <a href="{{ route('cart', ['user' => Auth::user()->id ?? 'guest']) }}">View cart</a>
                        </div>
                    </div>
                    <p id="total-pizza" data-aos="fade-up" data-aos-delay="300">+{{$pizzaQty}} Pizza has been added to cart</p>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="description-review-area pb-180 border-bottom-1 ">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="tab-style-2 nav mb-70" data-aos="fade-up" data-aos-delay="200">
                <a class="active" href="#des-details1" data-bs-toggle="tab">Description </a>
                <a href="#des-details2" data-bs-toggle="tab" class=""> Additonal Information </a>
                <!-- <a href="#des-details3" data-bs-toggle="tab" class=""> Review  </a> -->
                <!-- <a href="#des-details4" data-bs-toggle="tab"> Vendor Info </a>
                <a href="#des-details5" data-bs-toggle="tab"> About Brand </a> -->
            </div>
            <div class="tab-content">
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="pro-description-banner" data-aos="fade-up" data-aos-delay="300">
                                <img src="{{ asset('assets/images/product-details/pizza_chef.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="pro-description-content" data-aos="fade-up" data-aos-delay="400">
                                    <h2>Serving up Heavenly Slices, One Bite at a Time</h2>
                                    <p>At our Pizza Haven, we believe that every slice of pizza should be a heavenly experience. From the moment you take your first bite, you'll be transported to a realm of flavor and satisfaction.</p>
                                    <p>Our carefully crafted pizzas are made with the finest ingredients, each slice a masterpiece of taste and texture. Join us and discover the heavenly delight of our slices, one bite at a time.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="des-details2" class="tab-pane">
                    <div class="specification-wrap table-responsive">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="width1">Toppings</td>
                                    <td>Pepperoni, Mushrooms, Onions, Peppers, Olives</td>
                                </tr>
                                <tr>
                                    <td class="width1">Crust</td>
                                    <td>Thin Crust, Thick Crust, Stuffed Crust</td>
                                </tr>
                                <tr>
                                    <td class="width1">Specialty Pizzas</td>
                                    <td>Margherita, Meat Lovers, Hawaiian, Veggie Supreme</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#add-cart-form').on('submit', function(e) {
            e.preventDefault();

            let size = $('select[name="size"]').val();
            let pepperoni = $('select[name="pepperoni"]').val();
            let cheese = $('select[name="cheese"]').val();
            let quantity = $('input[name="quantity"]').val();

            // Check if any required field is not selected
            if (!size || !pepperoni || !cheese || !quantity) {
                // Show error message if any option is missing
                alert('Please select all options before adding to the cart.');
                return;
            }


            $.ajax({
                type: 'POST',
                url: '{{ route("add.cart") }}',
                data: $(this).serialize(),      //to send normal form submission
                success: function(response) {
                    alert(response.message);
                    $('#total-pizza').text('+' + response.qty + ' Pizza has been added to cart');
                },
                error: function(xhr) {
                if (xhr.status === 401 && xhr.responseJSON.redirect) {
                    // Redirect to the login page
                    window.location.href = xhr.responseJSON.redirect;
                } else {
                    alert('An error occurred while updating the cart.');
                }
            }
            });
        });
    });

</script>


</html>

@endsection
