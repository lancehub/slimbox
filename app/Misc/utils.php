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