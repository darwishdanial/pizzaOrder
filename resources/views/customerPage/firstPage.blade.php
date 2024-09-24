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

<script>

    // Wait for the DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Retrieve flash message from the session
        @if(session('message'))
            alert('{{ session('message') }}');
        @endif

        // Check if there is a flash message in the session and display it in an alert
        @if(session('error'))
            alert('{{ session('error') }}');
        @endif

        @if($errors->any())
            alert('{{ $errors->first() }}');
        @endif
    });
</script>

</html>

@endsection
