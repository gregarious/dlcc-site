<?php

function initializeSession() {
	if (!array_key_exists('alerts', $_SESSION) || !is_array($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	if (!array_key_exists('csrftoken', $_SESSION)) {
		$_SESSION['csrftoken'] = md5(uniqid(rand(), true));
	}
}

function authenticateUser($username, $password) {
	return $username === 'admin' && $password === 'admin';
}

function sessionIsAuthenticated() {
	return array_key_exists('username', $_SESSION);
}


function csrfTokenIsValid() {
	return array_key_exists('csrftoken', $_SESSION) &&
		   array_key_exists('csrftoken', $_POST) &&
		   $_SESSION['csrftoken'] === $_POST['csrftoken'];
}

function getValue($ar, $key, $defaultVal=NULL) {
	return array_key_exists($key, $ar) ? $ar[$key] : $defaultVal;
}

function renderPageHeader() {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Events Demo</title>
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.css">
	<!--[if lt IE 9]>
	<script type="text/javascript" src="/js/vendor/html5shiv.js"></script>
	<![endif]-->
</head>
<body>
<div class="container">
	<nav class="navbar" role="navigation">
<?php if (sessionIsAuthenticated()) { ?>
		<ul class="nav navbar-nav navbar-left">
			<li><a href="events.php">Events</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="logout.php">Logout</a></li>
		</ul>
<?php } else { ?>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="login.php">Login</a></li>
		</ul>
<?php } ?>
	</nav>
<?php
	foreach ($_SESSION['alerts'] as $alert) {
?>
		<div class="alert alert-warning"><?php echo $alert;?></div>
<?php
	}
	// clear alerts
	$_SESSION['alerts'] = array();
}

function renderPageFooter() {
?>
</div> <!-- .container -->

</body>
</html>
<?php
}