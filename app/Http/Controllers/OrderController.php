<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * 
     */

    public function index()
    {
        $orders = \App\Order::orderBy('created_at', 'desc')->paginate();

    	return view('orders.index', [
            'orders' => $orders
        ]);
    }


    /**
     * 
     */

    public function create(Request $request)
    {
        if ( $request->has('customer_id') )
        {
            $customer = \App\Customer::find($request->get('customer_id'));

            $order = $customer->createOrder();

            return redirect()->route('orders.edit', [ 'id' => $order->id]);
        }
        else
        {
            return redirect()->route('orders.create.selectcustomer');
        }
    }

    
    /**
     * 
     */

    public function selectcustomer()
    {
        return view('orders.selectcustomer');
    }


    /**
     * 
     */

    public function selectCustomerPost(Request $request)
    {
        $customers = \App\Customer::search($request->input('query'));

    	return view('orders.selectcustomer', [
    		'customers' => $customers
    	]);
    }


    /**
     * 
     */

    public function view($id)
    {
        $order = \App\Order::findOrFail($id);
        
        return view('orders.view', [
            'order' => $order,
            'doc' => $order->getDocument()
        ]);
    }


    /**
     * 
     */

    public function edit($id)
    {
        $order = \App\Order::find($id);

        return view('orders.edit', [
            'order' => $order,
            'doc' => $order->getDocument()
        ]);
    }
}
