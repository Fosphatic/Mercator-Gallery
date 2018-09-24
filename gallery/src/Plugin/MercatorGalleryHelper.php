<?php

/*

	Mercator's Gallery Extnesion for Pagekit - Based on Blueim
    Copyright (C) 2018 Helmut Kaufmann

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
    
*/ 


function resize_image($src , $dest , $toWidth , $toHeight , $jpgQuality, $options = array()) 
{
	if(!file_exists($src))
	{
		die("$src file does not exist");
	}
	
	//OPEN THE IMAGE INTO A RESOURCE
	$img = imagecreatefromjpeg ($src);	//try jpg
	
	if(!$img)
	{
		$img = imagecreatefromgif ($src);	//try gif
	}
	
	if(!$img)
	{
		$img = imagecreatefrompng ($src);	//try png
	}
	
	if(!$img)
	{
		return false;
		die("Could Not create image resource $src");
	}
	
	//ORIGINAL DIMENTIONS
	list( $width , $height ) = getimagesize( $src );
	
	//ORIGINAL SCALE
	$xscale=$width/$toWidth;
	$yscale=$height/$toHeight;
	
	//NEW DIMENSIONS WITH SAME SCALE
	if ($yscale > $xscale) 
	{
		$new_width = round($width * (1/$yscale));
		$new_height = round($height * (1/$yscale));
	}
	else 
	{
		$new_width = round($width * (1/$xscale));
		$new_height = round($height * (1/$xscale));
	}
	
	//NEW IMAGE RESOURCE
	if(!($imageResized = imagecreatetruecolor($new_width, $new_height)))
	{
		die("Could not create new image resource of width : $new_width , height : $new_height");
	}
	
	//RESIZE IMAGE
	if(! imagecopyresampled($imageResized, $img , 0 , 0 , 0 , 0 , $new_width , $new_height , $width , $height))
	{
		die('Resampling failed');
	}
	
	//STORE IMAGE INTO DESTINATION
	if(! imagejpeg($imageResized , $dest, $jpgQuality))
	{
		die("Could not save new file");
	}
	
	//Free the memory
	imagedestroy($img);
	imagedestroy($imageResized);
	
	return true;
}


function resize_thumb($src , $dest , $toWidth , $toHeight , $jpgQuality, $options = array()) 
{
		if(!file_exists($src))
	{
		die("$src file does not exist");
	}
	
	//OPEN THE IMAGE INTO A RESOURCE
	$img = imagecreatefromjpeg ($src);	//try jpg
	
	if(!$img)
	{
		$img = imagecreatefromgif ($src);	//try gif
	}
	
	if(!$img)
	{
		$img = imagecreatefrompng ($src);	//try png
	}
	
	if(!$img)
	{
		return false;
		die("Could Not create image resource $src");
	}
	
	//ORIGINAL DIMENTIONS
	list( $width , $height ) = getimagesize( $src );
	
	//ORIGINAL SCALE
	$xscale=$width/$toWidth;
	$yscale=$height/$toHeight;
	
	//NEW DIMENSIONS WITH SAME SCALE
	if ($yscale > $xscale) 
	{
		$new_width = round($width * (1/$yscale));
		$new_height = round($height * (1/$yscale));
	}
	else 
	{
		$new_width = round($width * (1/$xscale));
		$new_height = round($height * (1/$xscale));
	}
	
	if ($new_height > $toHeight) {
		$scale=$toHeight/$new_height;
		$new_width=$new_width/$scale;
		$new_height=$new_height/$scale;
	}
	else {
		$scale=$toHeight/$new_height;
		$new_width=$new_width*$scale;
		$new_height=$new_height*$scale;
	};
		
	
	
	//RESIZE IMAGE
	$imageResized=imagescale($img,  $new_width);
	
	//STORE IMAGE INTO DESTINATION
	if(! imagejpeg($imageResized , $dest, $jpgQuality))
	{
		die("Could not save new file");
	}
	
	//Free the memory
	imagedestroy($img);
	imagedestroy($imageResized);
	
	return true;
	
}

?>



