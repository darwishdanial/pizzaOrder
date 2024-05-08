<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class firstPageController extends Controller
{
    public $pizzaName = ['Small Normal Cheese', 'Small Extra Cheese', 'Small Pepperoni Normal Cheese', 'Small Pepperoni Extra Cheese', 
                        'Medium Normal Cheese', 'Medium Extra Cheese','Medium Pepperoni Normal Cheese', 'Medium Pepperoni  Cheese', 
                        'Large Normal Cheese', 'Large Extra Cheese', 'Large Pepperoni Normal Cheese', 'Large Pepperoni Extra Cheese'];
    
    public $pizzaPrice = [15, 21, 18, 24, 22,28,27,33, 30,36,37,43];
 
    public function index(){
        if (Session::has('pizzaQty') && !is_null(Session::get('pizzaQty'))) {
            $pizzaQty = Session::get('pizzaQty');
        } else {
            Session::put('pizzaQty',[0,0,0,0, 0,0,0,0, 0,0,0,0]);
        }
        // Session::put('pizzaQty',[0,0,0,0, 0,0,0,0, 0,0,0,0]);
        return view('pages.firstPage');
    }

    public function order(){
        $pizzaQty = session('pizzaQty', array_fill(0, 12, 0));
        $totalPizza = array_sum($pizzaQty);
        return view('pages.orderPage',['pizzaQty' => $pizzaQty, 'totalPizza'=> $totalPizza]);
    }

    public function cart(){
        $pizzaQty = session('pizzaQty', array_fill(0, 12, 0));
        return view('pages.cartPage', ['pizzaQty' => $pizzaQty, 'pizzaName' => $this->pizzaName]);
    }

    public function checkout(){
        $pizzaQty = session('pizzaQty', array_fill(0, 12, 0));

        $totalPrice = 0;
        foreach ($pizzaQty as $index => $quantity) {
            $totalPrice += $quantity * $this->pizzaPrice[$index];
        }

        return view('pages.checkoutPage', ['pizzaQty' => $pizzaQty, 'pizzaName' => $this->pizzaName, 'pizzaPrice' => $this->pizzaPrice, 'totalPrice' => $totalPrice]);
    }

    public function clearItem(){
        Session::forget('pizzaQty');
        return view('pages.checkoutPage');
    }

    public function addToCart(Request $request) {

        $size = $request->input('size');
        $pepperoni = $request->input('pepperoni');
        $cheese = $request->input('cheese');
        $quantity = $request->input('quantity');

        $pizzaQty = session('pizzaQty', array_fill(0, 12, 0));

        if ($size == 'Small' && $pepperoni == 'No' && $cheese == 'Normal') {
            $pizzaQty[0] += $quantity;
        } else if ($size == 'Small' && $pepperoni == 'No' && $cheese == 'Extra') {
            $pizzaQty[1] += $quantity;
        } else if ($size == 'Small' && $pepperoni == 'Yes' && $cheese == 'Normal') {
            $pizzaQty[2] += $quantity;
        } else if ($size == 'Small' && $pepperoni == 'Yes' && $cheese == 'Extra') {
            $pizzaQty[3] += $quantity;
        } else if ($size == 'Medium' && $pepperoni == 'No' && $cheese == 'Normal') {
            $pizzaQty[4] += $quantity;
        } else if ($size == 'Medium' && $pepperoni == 'No' && $cheese == 'Extra') {
            $pizzaQty[5] += $quantity;
        } else if ($size == 'Medium' && $pepperoni == 'Yes' && $cheese == 'Normal') {
            $pizzaQty[6] += $quantity;
        } else if ($size == 'Medium' && $pepperoni == 'Yes' && $cheese == 'Extra') {
            $pizzaQty[7] += $quantity;
        } else if ($size == 'Large' && $pepperoni == 'No' && $cheese == 'Normal') {
            $pizzaQty[8] += $quantity;
        } else if ($size == 'Large' && $pepperoni == 'No' && $cheese == 'Extra') {
            $pizzaQty[9] += $quantity;
        } else if ($size == 'Large' && $pepperoni == 'Yes' && $cheese == 'Normal') {
            $pizzaQty[10] += $quantity;
        } else if ($size == 'Large' && $pepperoni == 'Yes' && $cheese == 'Extra') {
            $pizzaQty[11] += $quantity;
        }

        session(['pizzaQty' => $pizzaQty]);

        // Redirect back to the order page after adding to cart
        return redirect()->route('order');
    }

    public function updateCart(Request $request) {

        $pizzaQty = session('pizzaQty', array_fill(0, 12, 0));

        $pizzaQty[0] = $request->input('quantity0') ?? 0;
        $pizzaQty[1] = $request->input('quantity1') ?? 0;
        $pizzaQty[2] = $request->input('quantity2') ?? 0;
        $pizzaQty[3] = $request->input('quantity3') ?? 0;
        $pizzaQty[4] = $request->input('quantity4') ?? 0;
        $pizzaQty[5] = $request->input('quantity5') ?? 0;
        $pizzaQty[6] = $request->input('quantity6') ?? 0;
        $pizzaQty[7] = $request->input('quantity7') ?? 0;
        $pizzaQty[8] = $request->input('quantity8') ?? 0;
        $pizzaQty[9] = $request->input('quantity9') ?? 0;
        $pizzaQty[10] = $request->input('quantity10') ?? 0;
        $pizzaQty[11] = $request->input('quantity11') ?? 0;

        session(['pizzaQty' => $pizzaQty]);

        // Redirect back to the cart page after updating the cart
        return redirect()->route('cart');
    }
}

