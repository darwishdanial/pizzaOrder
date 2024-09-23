<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\bill;

class adminStaffController extends Controller
{
    //
    public function index(){

        $currentUser = Auth::user();

        if($currentUser->user_type == 0){

            $staffCount = User::where('user_type', 1)->count();
            $cutomerCount = User::where('user_type', 2)->count();
            $activeBills = bill::where('is_active', true)
                            ->with('orders') 
                            ->get();
            $totalPayment = $activeBills->sum('total_price');
            $billCount = $activeBills->count();

            return view('pages.staffDashboardPage', ['activeBills' => $activeBills, 'staffCount' => $staffCount,
                         'cutomerCount' => $cutomerCount, 'totalPayment' => $totalPayment, 'billCount' => $billCount]);


        }else{

            $activeBills = bill::where('is_active', true)
                            ->with('orders') // Eager load orders
                            ->get();

            return view('pages.staffDashboardPage', ['activeBills' => $activeBills]);
        }

    }

    public function updateBillStatus(Request $request, $id){

        $bill = Bill::findOrFail($id);
        $newStatus = $request->input('status');
        $currentStatus = $bill->status;
        $bill->status = $newStatus +$currentStatus;
        $bill->save();

        return redirect()->back()->with('success', 'Pizza status updated successfully!');
    }

    public function billHistory(){
        
        $deactiveBills = bill::where('is_active', false)
                            ->with('orders', 'user') 
                            ->get();
        
        return view('pages.adminBillHistoryPage', ['deactiveBills' => $deactiveBills]);
    }
}
