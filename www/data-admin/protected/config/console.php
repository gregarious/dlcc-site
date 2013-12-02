<?php

date_default_timezone_set('US/Eastern');

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// application components
	'components'=>array(
	    // TODO-greg: compile all connection info in master file
		// dev creds
		'db'=>array(
			'connectionString' => 'mysql:host=dllccpittsburgh.db.12020684.hostedresource.com;dbname=dllccpittsburgh',
			'emulatePrepare' => true,
			'username' => 'dllccpittsburgh',
			'password' => 'D11ccMuffin!',
			'charset' => 'utf8',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
);