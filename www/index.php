<?php
	
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	
	// Load in config and $apps
	include_once('config.inc');
	include_once('apps.inc');
	
	// We are going to do a lot of date based goodness
	$today = date('Y-m-d');
	
	// Right, has an app been requested?
	if (isset($_GET['app'])) {
		$requested = $_GET['app'];
		
		// Is the app in the app array, and are we on time?
		if(isset($apps[$requested]) && $today >= $apps[$requested]['date']){
		
			print_r($apps[$requested]);
			exit();
		
		// Not in the array or too early... Back to the index page please
		} else {
			Redirect($base_url, false);
			exit();
		}
		
	}
	
	
	
	
	
	// We've not requested an app... should we be showing one today?
	$app = find_app_in_array($apps, $today);
	if ($app){
		Redirect($base_url . $app['slug'], false);
	}
	
	// We've not requested an app, and there is nothing to show so, lets just return the standard index page!
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