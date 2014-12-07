<?php
	
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	
	// Load in config and $apps
	include_once('config.inc');
	include_once('apps.inc');
	
	if(isset($_GET['app'])){
		print $_GET['app'];
		exit;
	}
			
	$today = date('Y-m-d');
	$app = find_app_in_array($apps, $today);
	
	if ($app) {
		Redirect($base_url . $app['slug'], false);
	}
	
	include_once('index.htm');
	
	function find_app_in_array($app_array, $today){
		foreach ($app_array as $key => $value){
			if($value['date'] == $today){
				return $value;
			}
		}
	}
	
	function Redirect($url, $permanent = false)
	{
	    header('Location: ' . $url, true, $permanent ? 301 : 302);
	    exit();
	}