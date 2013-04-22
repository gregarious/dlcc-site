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
		// TODO: remove before deploy
		// dev creds
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/dlcc.sqlite',
		),

		// TODO: remove before deploy
		// webfaction creds
		// 'db'=>array(
		// 	'connectionString' => 'mysql:host=localhost;dbname=gregarious_dlcc',
		// 	'emulatePrepare' => true,
		// 	'username' => 'gregarious_dlcc',
		// 	'password' => 'gregarious_dlcc',
		// 	'charset' => 'utf8',
		// ),

		
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