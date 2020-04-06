<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = \App\Customer::orderBy('lastname', 'desc')->paginate();

    	return view('customers.index', [
            'customers' => $customers
        ]);
    }

    public function view($id)
    {
        $customer = \App\Customer::find($id);

        return view('customers.view', [
            'customer' => $customer,
            'orders' => $customer->orders
        ]);
    }

}
