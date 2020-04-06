@extends('layouts.basic', [
	'mainClass' => 'main--full main--centered'
])


@section('main')




<div class="container container--small container--centered">
	
	<form method="post" action="<?php echo url()->current() ?>">

		<div class="fieldgroup">
			<div class="field">
				<input type="text" name="email" placeholder="Email address" class="field__input"/>
			</div>
			<div class="field">
				<input type="password" name="password" placeholder="Password" class="field__input"/>
			</div>
		</div>

		<div class="form__submit form__submit--alignment-centered">
			<input type="submit" value="Sign In" class="button button--size-full"/>
		</div>

		@csrf

	</form>

	<?php if ( $errors->hasBag()  ) : ?>
		<div class="dialog dialog--colour-red">
			<div class="dialog__body">
		<?php foreach ( $errors->all() as $message ): ?>
			<?php echo $message ?><br/>
		<?php endforeach ?>
			</div>
		</div>
	<?php endif ?>

</div>


@endsection
