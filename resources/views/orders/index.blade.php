@extends('layouts.full')


@section('main')

<div class="container">

	<h1>Orders</h1>

	<a href="<?php echo route('orders.create') ?>">Create Order</a>


	<div class="table-caption">
		Displaying <b><?php echo number_format($orders->firstItem()) ?></b>
		to <b><?php echo number_format($orders->lastItem()) ?></b>
		of <b><?php echo number_format($orders->total()) ?></b>
		orders
	</div>

	

	<table class="table">
	<tr>
		<th>#</th>
		<th>Date</th>
		<th>Customer</th>
		<th class="r">Total</th>
		<th>Channel</th>
		<th>Status</th>
	</tr>

	<?php foreach ( $orders as $order ): ?>

		<tr>
			<td><a href="<?php echo route('orders.view', ['id' => $order->id]) ?>"><?php echo $order->id ?></a></td>
			<td><?php echo $order->created_at ?></td>
			<td>{{ $order->customer_name }}</td>
			<td class="r">&pound; {{ number_format($order->total, 2) }}</td>
			<td>{{ $order->channel }}</td>
			<td>{{ $order->status }}</td>
		</tr>

	<?php endforeach ?>

	</table>

	{{ $orders->links() }}

</div>

@endsection