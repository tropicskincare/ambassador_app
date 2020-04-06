@extends('layouts.full')


@section('main')

<div class="container">

	<h1>Customers</h1>

	<a href="<?php echo route('customers.create') ?>">Create Customer</a>


	<div class="table-caption">
		Displaying <b><?php echo number_format($customers->firstItem()) ?></b>
		to <b><?php echo number_format($customers->lastItem()) ?></b>
		of <b><?php echo number_format($customers->total()) ?></b>
		customers
	</div>

	

	<table class="table">
	<tr>
		<th>Name</th>
		<th>City</th>
		<th>Last Order</th>
		<th>Total Revenue</th>
	</tr>

	<?php foreach ( $customers as $customer ): ?>

		<tr>
			<td><a href="<?php echo route('customers.view', ['id' => $customer->id]) ?>"><?php echo $customer->getName() ?></a></td>
			<td><?php echo $customer->city ?></td>
			<td><?php echo $customer->last_order_at ?></td>
			<td class="r">&pound; <?php echo number_format($customer->total_order_value, 2) ?></td>
		</tr>

	<?php endforeach ?>

	</table>

	{{ $customers->links() }}

</div>

@endsection