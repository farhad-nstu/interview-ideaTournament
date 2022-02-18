<?php
	function getValue($field, $data, $default=null){
	    return (!empty($data) && !empty($data->$field)) ? $data->$field : old($field,$default);
	}