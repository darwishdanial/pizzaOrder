<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use App\Models\User;

class adminStaffController extends Controller
{
    //
    public function index(){

        // Retrieve users with the specified user type
        $users = User::where('user_type', 2)->with('orders')->get();

        return view('pages.staffDashboardPage', ['users' => $users]);
    }
}
