<?php

function initializeSession() {
	session_start();
	if (!array_key_exists('alerts', $_SESSION) || !is_array($_SESSION['alerts'])) {
		$_SESSION['alerts'] = array();
	}
	if (!array_key_exists('csrftoken', $_SESSION)) {
		$_SESSION['csrftoken'] = md5(uniqid(rand(), true));
	}
}

function getConfig() {
	$path = realpath('../_private/config.ini');
	if (!$path) {
		die ('Unable to access configuration settings');
	}
	return parse_ini_file($path, true);
}

function authenticateUser($username, $password) {
	$config = getConfig();
	$authSettings = $config['webuser'];
	return $username === $authSettings['username'] &&
		   $password === $authSettings['password'];
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

function parseRequest() {
	return array('id' => 	 getValue($_GET, 'id'),
				 'action' => getValue($_GET, 'action'));
}

$defaultNavItems = array(
	array(
		'url' => 'events.php',
		'label' => 'Events'
		),
	array(
		'url' => 'restaurants.php',
		'label' => 'Restaurants'
		),
	array(
		'url' => 'hotels.php',
		'label' => 'Hotels'
		),
	array(
		'url' => 'parking.php',
		'label' => 'Parking'
		),
	array(
		'url' => 'attractions.php',
		'label' => 'Attraction'
		),
	);

/**
 * Print page header and nav bar
 * @param  [type] $navItems		Array of {label: <str>, url: <str>, active: <bool>} maps
 */
function renderPageHeader($title='', $navItems=null) {
	if ($navItems == null) {
		global $defaultNavItems;
		$navItems = $defaultNavItems;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>DLCC Data Management</title>
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="manage.css">
	<!--[if lt IE 9]>
	<script type="text/javascript" src="/pittsburghcc/muffintest/js/vendor/html5shiv.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="/pittsburghcc/muffintest/manage/">DLCC Data Management</a>
			</div>
<?php if (sessionIsAuthenticated()) { ?>
			<ul class="nav navbar-nav navbar-left">
<?php foreach ($navItems as $navItem) { ?>
				<li>
					<a href="<?php echo $navItem['url']; ?>"><?php echo $navItem['label']; ?></a>
				</li>
<?php } ?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="logout.php">Logout</a></li>
			</ul>
<?php } else { ?>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="login.php">Login</a></li>
			</ul>
<?php } ?>
		</div>
	</nav>

	<div class="container">
		<div class="page-header">
			<h1><?php echo $title; ?></h1>
		</div>

<?php foreach ($_SESSION['alerts'] as $alert) { ?>
		<div class="alert alert-warning"><?php echo $alert;?></div>
<?php 
	}
	// clear alerts
	$_SESSION['alerts'] = array();
}

function renderPageFooter() {
?>
</div> <!-- .container -->

<div class="footer">
	<div class="container">

	</div>
</div>

</body>
</html>
<?php
}

function connectDB() {
	$config = getConfig();
	$dbSettings = $config['database'];
	
	$conn = mysql_connect($dbSettings['host'], $dbSettings['username'], $dbSettings['password'])
	    or die('Could not connect: ' . mysql_error());
	mysql_select_db($dbSettings['name']) or die('Could not select database');;
	return $conn;
}

// could return bool or results array, depending on query type
function runQuery($query) {
	$conn = connectDB();

	$paramCount = func_num_args() - 1;
	$cleanParams = array();
	
	for ($i=1; $i <= $paramCount; $i++) { 
		array_push($cleanParams, mysql_real_escape_string(func_get_arg($i)));
	}

	$query = vsprintf($query, $cleanParams);
	$cursor = mysql_query($query);

	// if bool response, return immediately
	if (is_bool($cursor)) {
		return $cursor;
	}

	// otherwise, process the results array
	$results = array();
	while ($row = mysql_fetch_array($cursor, MYSQL_ASSOC)) {
	    array_push($results, $row);
	}

	mysql_close();
	return $results;
}
