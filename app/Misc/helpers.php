<?php

//all helper function for View

/********************* Layout, Template, Element, Block ***********************/

function render_with_layout($layout,$template,$data = array()){
	$app = get_app();
	$app->render($layout,array_merge(array('template'=>$template),$data));
	exit;
}

function render_return($template,$data = array()){
	$app = get_app();
	$layout = get_layout();
	$app->view()->appendData(array_merge(array('template'=>$template),$data));
	return $app->view()->fetch($layout);
}

function render($template,$data = array()){
	echo render_return($template,$data);
}

function get_layout(){
	$layout = get_config('use_layout');
	if(empty($layout)){
		$layout = 'default.php';
	}else{
		$layout = $layout.'.php';
	}
	return $layout;
}

function get_block($template,$data = array()){
	$app = get_app();
	$view = new \Slim\View();
	$view->setTemplatesDirectory($app->config('templates.path').'/blocks');
	$view->appendData($data);
	return $view->fetch($template);
}

function include_template($template){
	$app = get_app();
	$app->render($template,$app->view()->getData());
}

function include_element($element){
	echo include_template('elements/'.$element);
}

/********************* Static Related ***********************/

function include_css($css){
	echo '<link href="'.get_root().'/public/css/'.$css.'.css" rel="stylesheet">'."\r\n";
}

function include_js($js){
	echo '<script src="'.get_root().'/public/js/'.$js.'.js"></script>'."\r\n";
}

function echo_static($str = '',$with_domain = false){
	echo get_root($with_domain).'/public/'.$str;
}


/********************* POST Related ***********************/

function is_post(){
	$app = get_app();
	return $app->request()->isPost();
}

function get_post($field,$default = ''){
	$app = get_app();
	$value = $app->request()->post($field);
	if( empty($value) ){
		return $default;
	}
	else{
		return $value;
	}
}

function echo_post($field,$default = ''){
	$value = get_post($field,$default);
	echo $value;
}
