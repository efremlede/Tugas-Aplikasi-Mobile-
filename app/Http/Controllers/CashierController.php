<?php

namespace App\Http\Controllers;

class CashierController extends Controller
{
    public function index()
    {
        return view('cashier.index');
    }
}