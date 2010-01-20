<?php

class Painting {

	var $id;
	var $name;
	var $price;
	var $size;
	var $height;
	var $width;
	var $url;
	var $coms;

    function Painting($image) {
    	//$image->name = str_replace('\'','',$image->name);
    	list($this->name, $this->price, $this->size, $extra)= split ("@", $image->name, 4);
    	$this->height = $image->height;
		$this->width = $image->width;
		$this->url = $image->url;
		$this->id=$image->id;
		$this->coms = $image->coms;
    }
}
?>