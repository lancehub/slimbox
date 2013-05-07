<?php

//all util functions

function debug($o){
	echo '<pre>';
	print_r($o);
	echo '</pre>';
}

function get_app(){
	return \Slim\Slim::getInstance();
}

function get_config($key = ''){
	global $config;
	if(!empty($key)){
		if(isset($config[$key])){
			return $config[$key];
		}else{
			if(strstr($key,'.')!== false){
				$parts = explode('.',$key);
				$config_value = $config;
				foreach($parts as $part){
					if(isset($config_value[$part])){
						$config_value = $config_value[$part];
					}else{
						return null;
					}
				}
				return $config_value;
			}else{
				return null;
			}
		}
	}else{
		return $config;
	}
}

/********************* Path Related ***********************/

function redirect($path){
	$app = get_app();
	$app->redirect($path);
}

function get_root($with_domain = false){
	$app = get_app();
	$path = $app->request()->getRootUri();
	if($with_domain){
		$schema = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on')?'https':'http';
		$port = ($_SERVER['SERVER_PORT'] != 80)?(':'.$_SERVER['SERVER_PORT']):'';
		return $schema.'://'.$_SERVER['SERVER_NAME'].$port.$path;
	}else{
		return $path;
	}
}

function get_path($path,$with_domain = false){
	return get_root($with_domain).$path;
}


function get_current_path(){
	$app = get_app();
	return $app->request()->getResourceUri();
}

/********************* Model Related ***********************/

//convert Active Record find('all') results to array of array;
function model_to_array($list){
	$ret = array();
	foreach($list as $value){
		$ret[] = $value->to_array();
	}
	return $ret;
}

//convert Active Record results to key=>value pairs array
function array_to_list($array,$kkey,$vkey){
	$ret = array();
	foreach($array as $value){
		$ret[$value[$kkey]] = $value[$vkey];
	}
	return $ret;
}

//use $kkey as the key of the Active Record results
function array_for_key($array,$kkey){
	$ret = array();
	foreach($array as $value){
		$ret[$value[$kkey]] = $value;
	}
	return $ret;
}
