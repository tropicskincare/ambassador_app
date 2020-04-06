<html>

<head>

	<title><?php echo config('app.name') ?></title>
    <meta charset="utf-8"/>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet"/>
   
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/all.css') }}"/>

</head>

<body class="<?php if ( isset($bodyClass) ) echo "$bodyClass" ?>">



<header class="header">
	<div class="container container--header">
		<a class="logo" href="<?php echo route('dashboard') ?>"></a>
		<?php if ( Auth::check() ): ?>

			<nav class="nav">
				<ul class="nav__list">
					<li class="nav__list__item"><a href="<?php echo route('orders') ?>" class="nav__list__item__link">Your Orders</a></li>
					<li class="nav__list__item"><a href="<?php echo route('events') ?>" class="nav__list__item__link">Your Pampers</a></li>
					<li class="nav__list__item"><a href="<?php echo route('customers') ?>" class="nav__list__item__link">Your Customers</a></li>
					<li class="nav__list__item"><a href="<?php echo route('events') ?>" class="nav__list__item__link">Your Earnings</a></li>
				</ul>
			</nav>

			<div class="session">
				
				<div class="session__name">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</div>
								
			</div>

		<?php endif ?>
	</div>
</header>







<div class="main<?php if ( isset($mainClass) ) echo " $mainClass" ?>">
	@yield('main')
</div>





<footer class="footer">


</footer>





</body>

</html>