<html>

<head>

	<title><?php echo config('app.name') ?></title>
    <meta charset="utf-8"/>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet"/>
   
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/all.css') }}"/>

</head>

<body>

<header class="header">
	<div class="container container--header">
		<a class="logo logo--centered" href="<?php echo route('dashboard') ?>"></a>
	</div>
</header>


<div class="main<?php if ( isset($mainClass) ) echo " $mainClass" ?>">
	@yield('main')
</div>

<footer class="footer"></footer>

</body>

</html>