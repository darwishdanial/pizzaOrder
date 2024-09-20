<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class adminStaffController extends Controller
{
    //
    public function index(){

        // Retrieve users with the specified user type
        

        $currentUser = Auth::user();

        if($currentUser->user_type == 0){

            $customers = User::where('user_type', 2)->with('orders')->get();
            $staffCount = User::where('user_type', 1)->count();
            $cutomerCount = 0;
            $countOrder = 0;
            $totalPayment = 0;

            foreach($customers as $user){
                $cutomerCount +=1;
                
                foreach($user->orders as $order){
                    $countOrder += $order->qty;
                    $totalPayment += $order->price;
                }
            }

            return view('pages.staffDashboardPage', ['customers' => $customers, 'staffCount' => $staffCount,
                        'cutomerCount' => $cutomerCount, 'countOrder' => $countOrder, 'totalPayment' => $totalPayment]);


        }else{

            $customers = User::where('user_type', 2)->with('orders')->get();

            return view('pages.staffDashboardPage', ['customers' => $customers]);
        }

    }
}
