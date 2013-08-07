<?php

\Slim\Route::setDefaultConditions(array(
	'id' => '\d*',
));

$app->get('/',instance('\Controller\Pages','index'))->name('home');

$app->get('/noop',function(){
	echo 'Nothing happen!'."\r\n";
});


