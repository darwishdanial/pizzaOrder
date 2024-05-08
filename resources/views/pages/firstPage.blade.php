@extends('layout.app')

@section('content')

<html>

<div class="slider-area">
        <div class="slider-active-1 nav-style-1">
            <div
                class="single-slider-wrap slider-height-1 custom-d-flex custom-align-item-center single-animation-wrap">
                <div class="slider-img">
                    <img src="assets/images/slider/pizza.jpg" alt="">
                </div>
                <div class="slider-content slider-animated-1">
                    <h3 class="animated">PIZZA HAVEN</h3>
                    <h1 class="animated">Best Pizza <br> In Town</h1>
                    <div class="btn-style">
                        <a class="btn btn-outline-primary slider-btn animated" href="{{ route('order') }}">Order
                            now</a>
                    </div>
                    
                </div>
            </div>
        </div>
</div>

</html>

@endsection
