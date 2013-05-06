<?php
session_name('slimbox');
session_start();

//all autoload libs
require 'vendor/autoload.php';

//config values and functions
require 'app/Misc/config.php';
require 'app/Misc/utils.php';
require 'app/Misc/helpers.php';

date_default_timezone_set(get_config('timezone'));

//database config
ActiveRecord\Config::initialize(function($cfg)
{
	$cfg->set_connections(array('development' => 'mysql://'.get_config('db.user').':'.get_config('db.pass').'@'.get_config('db.host').'/'.get_config('db.db_name').';charset=utf8'));
});

//define app
$app = new \Slim\Slim(array(
	'templates.path'=>'app/View',
	'debug' => true
));

//define app routes
require 'app/Misc/routes.php';

//fire it
$app->run();
