<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\order;
use Illuminate\Support\Facades\Auth;

class firstPageController extends Controller
{
    public $pizzaName = ['Small Normal Cheese', 'Small Extra Cheese', 'Small Pepperoni Normal Cheese', 'Small Pepperoni Extra Cheese', 
                        'Medium Normal Cheese', 'Medium Extra Cheese','Medium Pepperoni Normal Cheese', 'Medium Pepperoni  Cheese', 
                        'Large Normal Cheese', 'Large Extra Cheese', 'Large Pepperoni Normal Cheese', 'Large Pepperoni Extra Cheese'];

    public $pizzaPrice = [15, 21, 18, 24, 22,28,27,33, 30,36,37,43];

    public $pizzas = [
        ['name' => 'Small Normal Cheese', 'price' => 15],
        ['name' => 'Small Extra Cheese', 'price' => 21],
        ['name' => 'Small Pepperoni Normal Cheese', 'price' => 18],
        ['name' => 'Small Pepperoni Extra Cheese', 'price' => 24],
        ['name' => 'Medium Normal Cheese', 'price' => 22],
        ['name' => 'Medium Extra Cheese', 'price' => 28],
        ['name' => 'Medium Pepperoni Normal Cheese', 'price' => 27],
        ['name' => 'Medium Pepperoni Extra Cheese', 'price' => 33],
        ['name' => 'Large Normal Cheese', 'price' => 30],
        ['name' => 'Large Extra Cheese', 'price' => 36],
        ['name' => 'Large Pepperoni Normal Cheese', 'price' => 37],
        ['name' => 'Large Pepperoni Extra Cheese', 'price' => 43],
    ];
    
 
    // public function index(){
    //     // if (Session::has('pizzaQty') && !is_null(Session::get('pizzaQty'))) {
    //     //     $pizzaQty = Session::get('pizzaQty');
    //     // } else {
    //     //     Session::put('pizzaQty',[0,0,0,0, 0,0,0,0, 0,0,0,0]);
    //     // }
    //     // Session::put('pizzaQty',[0,0,0,0, 0,0,0,0, 0,0,0,0]);
    //     return view('pages.firstPage');
    // }

    public function order(){


        if (auth()->check()) {
            $user = auth()->user();

            $pizzaOrder = Order::where('user_id', $user->id)->get();
    
            $pizzaQty = $pizzaOrder->sum('qty');
        } else {
            $pizzaQty = 0;
        }

        return view('pages.orderPage',['pizzaQty' => $pizzaQty]);
    }

    public function cart(){
        // $pizzaQty = session('pizzaQty', array_fill(0, 12, 0));
        $user = auth()->user();

        $pizzaOrder = Order::where('user_id', $user->id)->get();
        //return view('pages.cartPage', ['pizzaQty' => $pizzaQty, 'pizzaName' => $this->pizzaName]);
        return view('pages.cartPage', ['pizzaOrder' => $pizzaOrder]);
    }

    public function checkout(){
        // $pizzaQty = session('pizzaQty', array_fill(0, 12, 0));

        // $totalPrice = 0;
        // foreach ($pizzaQty as $index => $quantity) {
        //     $totalPrice += $quantity * $this->pizzaPrice[$index];
        // }

        $user = auth()->user();

        $pizzaOrder = Order::where('user_id', $user->id)->get();
        // $totalPrice = 0;
        // foreach($pizzaOrder as $pizza){
        //     $totalPrice += $pizza->price;
        // }
        $totalPrice = $pizzaOrder->sum('price');

        return view('pages.checkoutPage', ['pizzaOrder' => $pizzaOrder, 'totalPrice' => $totalPrice]);
    }

    public function clearItem(){
        // Session::forget('pizzaQty');
            // Get the currently authenticated user
        $user = auth()->user();

        // Delete only the pizza orders for the current user
        Order::where('user_id', $user->id)->delete();

        // Fetch the remaining pizza orders (for other users, if needed)
        $pizzaOrder = Order::where('user_id', $user->id)->get();
        $totalPrice = 0;
        
        return view('pages.checkoutPage', ['pizzaOrder' => $pizzaOrder, 'totalPrice' => $totalPrice]);
    }

    public function addToCart(Request $request) {

        if ($request->ajax()) {

            $user = auth()->user();

            $size = $request->input('size');
            $pepperoni = $request->input('pepperoni');
            $cheese = $request->input('cheese');
            $quantity = $request->input('quantity');
            $price=0;
            $pizzaName = '';

            if ($pepperoni == "No") {
                $pizzaName = $size.' '.$cheese;
            }else{
                $pizzaName = $size.' '.$pepperoni.' '.$cheese;
            }

            $order = Order::where('name', $pizzaName)
                      ->where('user_id', $user->id)
                      ->first();

            foreach ($this->pizzas as $pizza) {
                if ($pizza["name"] == $pizzaName) {
                    $price = $pizza["price"];
                    break;
                }
            }

            if ($order) {
                // If the pizza already exists, update its quantity
                $tempqty = $order->qty;
                $tempqty += $quantity;
                $order->qty = $tempqty;
                $order->price = $price * $tempqty;
                $order->save();

            } else {
                $order = new Order([
                    'name' => $pizzaName,
                    'qty' => $quantity,
                    'price' => $price * $quantity,
                    'user_id' => $user->id,
                ]);

                $order->save();
            }

            $pizzaOrder = Order::where('user_id', $user->id)->get();
            $pizzaQty = $pizzaOrder->sum('qty');

            return response()->json([
                'success' => true,
                'qty' => $pizzaQty,
                'message' => 'Cart updated successfully!',
            ]);

        }
        // Redirect back to the order page after adding to cart
        return redirect()->route('order');
    }

    public function updateCart(Request $request)
    {
        $user = auth()->user();

        // Check if the request is an AJAX request
        if ($request->ajax()) {
            // Retrieve all input values from the form
            $quantities = $request->input('quantity');
            $updatedOrders = [];

            // Loop through each pizza quantity and update the database
            foreach ($quantities as $pizzaId => $quantity) {
                // Find the pizza order by ID
                $order = Order::where('id', $pizzaId)
                          ->where('user_id', $user->id)
                          ->firstOrFail();

                if ($quantity == 0) {
                    $order->delete();
                } else {
                    $price = 0;

                    foreach ($this->pizzas as $pizza) {
                        if ($pizza["name"] == $order->name) {
                            $price = $pizza["price"] * $quantity;
                            break;
                        }
                    }

                    // Update the quantity and price
                    $order->qty = $quantity;
                    $order->price = $price;

                    // Save the changes
                    $order->save();
                    $updatedOrders[] = $order;
                }
            }

            // Prepare the response data
            // $updatedOrders = Order::all();
            // $totalPrice = $updatedOrders->sum('price');

            return response()->json([
                'success' => true,
                'orders' => $updatedOrders,
                'message' => 'Cart updated successfully!',
                // 'message' => 'Cart updated successfully!',
                // 'orders' => $updatedOrders,
                // 'totalPrice' => $totalPrice,
            ]);
        }

        // Fallback for non-AJAX requests
        return redirect()->route('cart')->with('success', 'Cart updated successfully!');
    }
}

