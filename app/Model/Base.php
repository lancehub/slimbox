<?php
namespace Model;

class Base extends \ActiveRecord\Model
{
	
	public function get_error_messages(){
		$full_messages = array();
		$raw_errors = $this->errors->get_raw_errors();

		if ($raw_errors)
		{
			foreach ($raw_errors as $attribute => $messages)
			{
				foreach ($messages as $msg)
				{
					if (is_null($msg))continue;
					
					$field_name = $this->field_name($attribute);
					$message = $field_name.' '.$msg;
					$full_messages[] = $message;
				}
				
			}
		}
		return $full_messages;
	}
	
	public function field_name($attribute){
		return \ActiveRecord\Utils::human_attribute($attribute);
	}
}