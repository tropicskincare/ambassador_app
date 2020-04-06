@extends('layouts.full')


@section('main')

<div class="container">

	<h1>Order {{ $order->id }}</h1>


	<div class="box">
		<div class="box__header">
			Customer
		</div>
		<div class="box__body">
			{{ $doc['customer']['firstname'] }} {{ $doc['customer']['lastname'] }}<br/>
			{{ $doc['customer']['address'] ?? '' }}<br/>
			{{ $doc['customer']['city'] ?? '' }}<br/>
			{{ $doc['customer']['county'] ?? '' }}<br/>
			{{ $doc['customer']['postcode'] ?? '' }}<br/>
			{{ $doc['customer']['country'] ?? ''}}<br/>
		</div>
	</div>




	<table class="table">
	<tr>
		<th>Qty</th>
		<th>Name</th>
		<th class="r">Unit Price</th>
		<th class="r">Total Price</th>
	</tr>

	<?php foreach ( $doc['items'] as $item ) : ?>


		<tr>
			<td>{{ $item['quantity'] }}</td>
			<td>{{ $item['name'] }}</td>
			<td class="r">&pound; {{ $item['unit_price'] }}</td>
			<td class="r">&pound; {{ $item['total_price'] }}</td>
		</tr>


	<?php endforeach ?>
	
	<tr>
		<td colspan="3" class="r">Sub Total:</td>
		<td class="r">&pound; {{ $order->subtotal }}</td>
	</tr>

	<tr>
		<td colspan="3" class="r">Shipping:</td>
		<td class="r">&pound; {{ $order->shipping }}</td>
	</tr>

	<tr>
		<td colspan="3" class="r">Order Total:</td>
		<td class="r">&pound; {{ $order->total }}</td>
	</tr>

	</table>

</div>

@endsection