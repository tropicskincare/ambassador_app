@extends('layouts.full')


@section('main')

<div class="container">

	<h1>{{ $customer->getName() }}</h1>



	
	<h2>{{ $customer->firstname }}'s Orders</h2>

	<table class="table">
	<tr>
		<th>#</th>
		<th>Date</th>
		<th>Customer</th>
		<th>Channel</th>
		<th>Status</th>
	</tr>

	<?php foreach ( $orders as $order ): ?>

		<tr>
			<td><a href="<?php echo route('orders.view', ['id' => $order->id]) ?>"><?php echo $order->id ?></a></td>
			<td><?php echo $order->created_at ?></td>
			<td><?php echo $order->customer->getName() ?></td>
			<td><?php echo $order->channel ?></td>
			<td><?php echo $order->status ?></td>
		</tr>

	<?php endforeach ?>

	</table>
	
</div>

@endsection