<?php


function words($value, $words = 30, $end = '...')
{
	return \Illuminate\Support\Str::words($value, $words, $end);
}

function shortClassName($class)
{
	$path = explode('\\', $class);
	return array_pop($path);
}

function getUserLocation()
{
	$json = file_get_contents('http://dazzlepod.com/ip/me.json');
	$obj = json_decode($json);
	$obj->location = $obj->country. ', '. $obj->city;
	
	return $obj;
}