<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<!-- Fonts -->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body >


	<nav class="light-blue lighten-1" role="navigation">
		<div class="nav-wrapper container-fluid"><a id="logo-container" href="#" class="brand-logo">Logo</a>
			<ul class="right hide-on-med-and-down">
				<li class="dropdown navbarli">
					<a class='dropdown-button' href="\home">{{ Auth::user()->name }} <span class="caret"></span></a>
				</li>
						<li class=" navbarli"><a href="{{ url('/auth/logout') }}">Logout</a></li>

							<li class=" navbarli"><a href="{{ url('/videos') }}">Videos</a></li>

			</ul>

			<ul id="nav-mobile" class="side-nav">
				<li><a href="#">Navbar Link</a></li>

			</ul>
			<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
		</div>

</nav>

<body style="background:url('../images/back.jpg');background-size:100% 100%;background-repeat:no-repeat;background-attachment:fixed;">

	<div class="navbar-fixed ">
		<nav>
			<div class="nav-wrapper green accent-2">
				<a href="#!" class="brand-logo right black-text">STUDYHERE</a>
				<ul class="left hide-on-med-and-down">
					<li class="active"><a href="{{url('/')}}" class="black-text">HOME</a></li>
					<li><a href="collapsible.html" class="black-text">CONTACT</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
						</ul>
					</li>

				</ul>
			</div>
		</nav>
	</div>

	</div>
	</div>

	</nav>






	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
<script>
$('.dropdown-button').dropdown({
		inDuration: 300,
		outDuration: 225,
		constrain_width: false, // Does not change width of dropdown to that of the activator
		hover: true, // Activate on hover
		gutter: 0, // Spacing from edge
		belowOrigin: false // Displays dropdown below the button
	}
);
</script>

</body>

</html>
