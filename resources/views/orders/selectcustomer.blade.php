@extends('layouts.full')


@section('main')

<div class="container">


	<h1>Select Customer</h1>

	<form method="post" action="<?php echo url()->current() ?>">

		<div class="fieldgroup">
			<div class="field">
				<label class="field__label">Search for customer</label>
				<input type="text" name="query" value="{{ request('query','') ?? '' }}" class="field__input" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"/>
			</div>
		</div>
		
		<?php if ( isset($customers) ) : ?>

			<h2>Search results</h2>

			<table class="table">

			<?php foreach ( $customers as $customer ) : ?>

				<tr>
					<td>{{ $customer->firstname }} {{ $customer->lastname }}<br/>
					<small>{{ $customer->city }}</small>
					</td>
					<td><a href="<?php echo route('orders.create', ['customer_id' => $customer->id]) ?>" class="button button--size-small">Create Order</a></td>
				</tr>

			<?php endforeach ?>

		</table>

		<?php endif ?>

		@csrf

	</form>




</div>

@endsection