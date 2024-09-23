<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\bill;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

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
    
    public function viewCustomerList(){
        $customer = User::where('user_type', 2)->get();

        return view('pages.customerListPage', ['customer' => $customer]);
    }

    public function deleteCustomer($id){
        $customerDelete = user::findOrFail($id);
        $customerDelete->delete();
        $customer = User::where('user_type', 2)->get();

        return redirect()->back()->with('success', 'Customer deleted successfully!');
    }

    public function editCustomer($id){
        $customerEdit = user::findOrFail($id);

        return view('pages.customerEditPage', ['customerEdit' => $customerEdit]);
    }

    public function saveCustomer(Request $request, $id){
        $customerEdit = user::findOrFail($id);
        $customerEdit->name = $request->input('name');
        $customerEdit->email = $request->input('email');
        $customerEdit->save();

        return redirect()->route('admin.customerList');
    }

    public function viewStaffList(){
        $staff = User::where('user_type', 1)->get();

        return view('pages.staffListPage', ['staff' => $staff]);
    }

    public function deleteStaff($id){
        $staffDelete = user::findOrFail($id);
        $staffDelete->delete();

        return redirect()->back()->with('success', 'Customer deleted successfully!');
    }

    public function editStaff($id){
        $staffEdit = user::findOrFail($id);

        return view('pages.staffEditPage', ['staffEdit' => $staffEdit]);
    }

    public function saveStaff(Request $request, $id){
        $staffEdit = user::findOrFail($id);
        $staffEdit->name = $request->input('name');
        $staffEdit->email = $request->input('email');
        $staffEdit->save();

        return redirect()->route('admin.customerList');
    }

    public function storeStaff(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 1,
        ]);

        event(new Registered($user));

        return redirect()->route('staff.view.store')->with('success', 'Account created successfully!');
    }
}
