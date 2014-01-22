<?php

require_once("_common.php");
require_once("processors/parking_processor.php");

// starts session, sets default values for 'alerts' and 'csrftoken' if necessary
initializeSession();

date_default_timezone_set('US/Eastern');

if (!sessionIsAuthenticated()) {
	array_push($_SESSION['alerts'], 'You must log in to access this page.');
	header("Location: /pittsburghcc/muffintest/manage/login.php");
	exit;
}

$requestArgs = parseRequest();

$processor = new EventProcessor("parking.php");

if (is_null($requestArgs['id'])) {
	$processor->processListRequest(getValue($requestArgs, 'action'));
}
else {
	$processor->processDetailsRequest(getValue($requestArgs, 'action'), $requestArgs['id']);
}
