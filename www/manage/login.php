<?php
require_once("_common.php");

// starts session, sets default values for 'alerts' and 'csrftoken' if necessary
initializeSession();

if (sessionIsAuthenticated()) {
	renderPageHeader();
	showAlreadyLoggedInMessage();
	renderPageFooter();
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (csrfTokenIsValid()) {
		$username = getValue($_POST, 'username');
		$password = getValue($_POST, 'password');
		
		if (authenticateUser($username, $password)) {
			$_SESSION['username'] = $username;
			header("Location: /manage/index.php");
			exit;
		}
		else {
			array_push($_SESSION['alerts'], 'Incorrect username or password');
		}
	}
	else {
		array_push($_SESSION['alerts'], 'Problem logging in');
	}
}

renderPageHeader();
renderLoginForm();
renderPageFooter();
?>

<?php
function showAlreadyLoggedInMessage() {
?>
	<p>You are already logged in.</p>
	<p><a href="logout.php">Click here if you would like to log out instead.</a></p>
<?php
}

function renderLoginForm() {
?>
	<form action="login.php" method="POST">
	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" name="username" id="username">
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" name="password" id="password">
	</div>
	<input type="hidden" name="csrftoken" value="<?php echo getValue($_SESSION, 'csrftoken', ''); ?>">
	<input type="submit" class="btn btn-primary" value="Login"></input>
<?php
}