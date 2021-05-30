<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::user()->id)->with('user', 'gem')->latest()->get();
        return view('home', compact('orders'));
    }

    public function invoice(Order $order)
    {
//        $items = json_decode($order->gems);
        return view('invoice', compact('order'));
    }
}
