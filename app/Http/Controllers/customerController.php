<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\order;
use App\Models\bill;
use Illuminate\Support\Facades\Auth;

class customerController extends Controller
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
    
    public function order(){


        if (auth()->check()) {
            $user = auth()->user();
            $pizzaQty = Order::where('user_id', $user->id)
                            ->where('is_active', true)
                            ->sum('qty');
        } else {
            $pizzaQty = 0;
        }

        return view('customerPage.orderPage',['pizzaQty' => $pizzaQty]);
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
                      ->where('is_active', true)
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

            $pizzaQty = Order::where('user_id', $user->id)
                            ->where('is_active', true)
                            ->sum('qty');

            return response()->json([
                'success' => true,
                'qty' => $pizzaQty,
                'message' => 'Cart updated successfully!',
            ]);

        }

        return redirect()->route('order');
    }

    public function cart(){
        // $pizzaQty = session('pizzaQty', array_fill(0, 12, 0));
        $user = auth()->user();

        // $pizzaOrder = Order::where('user_id', $user->id)->get();
        $pizzaOrder = Order::where('user_id', $user->id)
                    ->where('is_active', true)
                    ->get();
                    
        return view('customerPage.cartPage', ['pizzaOrder' => $pizzaOrder]);
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
                          ->where('is_active', true)
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

            return response()->json([
                'success' => true,
                'orders' => $updatedOrders,
                'message' => 'Cart updated successfully!',
            ]);
        }

        // Fallback for non-AJAX requests
        return redirect()->route('cart')->with('success', 'Cart updated successfully!');
    }

    public function checkout(){

        $user = auth()->user();
        $emptyPizza = "no";
        $pizzaStatus = 0;
        $pizzaOrder = Order::where('user_id', $user->id)
                         ->where('is_active', true)
                         ->get();
        if ($pizzaOrder->isEmpty()) {
            $pizzaOrder = Order::where('user_id', $user->id)
                                ->where('is_active', false)
                                ->first();
            //tukar kepada retrive bill
            $pizzaOrder = collect($pizzaOrder ? [$pizzaOrder] : []);
            $pizzaStatus = 1;

        }
        if ($pizzaOrder->isEmpty()) {
            $emptyPizza = "yes";
        }
        $totalPrice = $pizzaOrder->sum('price');

        return view('customerPage.checkoutPage', ['pizzaOrder' => $pizzaOrder, 'totalPrice' => $totalPrice, 'emptyPizza' => $emptyPizza, 'pizzaStatus' => $pizzaStatus]);
    }

    public function viewDeliveryStatus(){

        $user = auth()->user();
        $emptyBill = "no";
        $activeBills = bill::where('user_id', $user->id)
                   ->where('is_active', true)
                   ->with('orders') // Eager load orders
                   ->get();
        if ($activeBills->isEmpty()) {
            $activeBills = collect($activeBills ? [$activeBills] : []);
            $emptyBill = "yes";
        }

        return view('customerPage.deliveryStatusPage', ['activeBills' => $activeBills, 'emptyBill' => $emptyBill]);
    }

    public function clearItem(){

        $user = auth()->user();
        $activeBills = Order::where('user_id', $user->id)
                            ->where('is_active', true)
                            ->get();

        if ($activeBills->isNotEmpty()) {

            $totalPrice = $activeBills->sum('price');

            $bill = new bill([
                'user_id' => $user->id,
                'status' => 0,
                'is_active' =>true,
                'total_price' => $totalPrice,
                
            ]);
            $bill->save();

            foreach($activeBills as $pizza){
                $pizza->bill_id = $bill->id;
                $pizza->is_active = false;
                $pizza->save();
            }
        }

        return redirect()->route('viewBillHistory');
    }

    public function clearBill($id){

        $billUpdate = Bill::findOrFail($id);
        $billUpdate-> is_active = false;
        $billUpdate->save();

        return redirect()->route('viewBillHistory');
    }

    public function viewBillHistory(){

        $emptyBillHistory="";
        $user = auth()->user();
        $deactiveBills = bill::where('user_id', $user->id)
                            ->where('is_active', false)
                            ->with('orders')
                            ->get();
        if ($deactiveBills->isEmpty()) {
            $emptyBillHistory = "yes";
        }

        return view('customerPage.billHistoryPage', ['deactiveBills' => $deactiveBills, 'emptyBillHistory' => $emptyBillHistory]);
    }


}

