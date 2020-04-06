<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Public - Admin Routes
 */

Route::get('/signin', 'SessionController@login')->name('login');
Route::post('/signin', 'SessionController@loginPost');


/**
 * Protected Admin Routes
 */

Route::middleware('auth')->group(function()
{
	/**
	 * Default
	 */

	Route::get('/', 'DashboardController@index')->name('dashboard');


	/**
	 * Orders
	 */

	Route::get('/orders', 'OrderController@index')->name('orders');
	Route::get('/orders/create', 'OrderController@create')->name('orders.create');
	Route::post('/orders/create', 'OrderController@createPost');

	Route::get('/orders/selectcustomer', 'OrderController@selectCustomer')->name('orders.create.selectcustomer');
	Route::post('/orders/selectcustomer', 'OrderController@selectCustomerPost');

	Route::get('/orders/{id}/edit', 'OrderController@edit')->name('orders.edit');


	Route::get('/orders/{id}', 'OrderController@view')->name('orders.view');


	/**
	 * Customers
	 */

	Route::get('/customers', 'CustomerController@index')->name('customers');
	Route::get('/customers/create', 'CustomerController@create')->name('customers.create');
	Route::get('/customers/{id}', 'CustomerController@view')->name('customers.view');


	/**
	 * Pampers
	 */

	Route::get('/events', 'EventController@index')->name('events');
	Route::get('/events/create', 'EventController@create')->name('events.create');


});