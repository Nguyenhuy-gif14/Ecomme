<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Auth::user()->orders()->orderBy('created_at', 'desc')->paginate(10);
        return view('order_history', compact('orders'));
    }

    public function show($id)
    {
        $order = Auth::user()->orders()->findOrFail($id);
        return view('order_detail', compact('order'));
    }
}
