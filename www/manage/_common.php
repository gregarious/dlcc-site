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

function parseRequest() {
	return array('id' => 	 getValue($_GET, 'id'),
				 'action' => getValue($_GET, 'action'));
}

/**
 * Print page header and nav bar
 * @param  [type] $navItems		Array of {label: <str>, url: <str>, active: <bool>} maps
 */
function renderPageHeader($navItems) {
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
	</nav>
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

</body>
</html>
<?php
}

function connectDB() {
	$conn = mysql_connect('localhost', 'root', '')
	    or die('Could not connect: ' . mysql_error());
	mysql_select_db('dlcc') or die('Could not select database');;
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
