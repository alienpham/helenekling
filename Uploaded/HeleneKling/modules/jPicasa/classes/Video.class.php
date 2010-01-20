<?php

class Video {
	var $name;
	var $url;
	var $description;
	
	function Video($file) {
    	$params = explode ("@", $file);
    	$this->name = str_replace(".flv", "", $params[0]);
    	if(count($params)> 1)
    		 $this->description = $params[1];
    	else $this->description = null;
    		  
    	$this->url = $file;
    }
}