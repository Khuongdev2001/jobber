<?php
return [

	/*
	|--------------------------------------------------------------------------
	| Config Language
	|--------------------------------------------------------------------------
	|
	| Here you can config your yunpian api key from yunpian provided.
	|
	| Options: ['zh-cn', 'zh-tw', 'en', 'ja', 'ko']
	|
	*/
	'lang' => 'en',

	/*
	|--------------------------------------------------------------------------
	| Config Geetest Id
	|--------------------------------------------------------------------------
	|
	| Here you can config your yunpian api key from yunpian provided.
	|
	*/
	'id' => env('GEETEST_ID','1adf17e6abc22867aefd3d504d0e241d'),

	/*
	|--------------------------------------------------------------------------
	| Config Geetest Key
	|--------------------------------------------------------------------------
	|
	| Here you can config your yunpian api key from yunpian provided.
	|
	*/
	'key' => env('GEETEST_KEY','3f0bcd3ffaafade31a9938abaec7d023'),

	/*
	|--------------------------------------------------------------------------
	| Config Geetest URL
	|--------------------------------------------------------------------------
	|
	| Here you can config your geetest url for ajax validation.
	|
	*/
	'url' => 'geetest',

	/*
	|--------------------------------------------------------------------------
	| Config Geetest Protocol
	|--------------------------------------------------------------------------
	|
	| Here you can config your geetest url for ajax validation.
	| 
	| Options: http or https
	|
	*/
	'protocol' => 'http',

	/*
	|--------------------------------------------------------------------------
	| Config Geetest Product
	|--------------------------------------------------------------------------
	|
	| Here you can config your geetest url for ajax validation.
	| 
	| Options: float, popup, custom, bind
	|
	*/
	'product' => 'float',

	/*
	|--------------------------------------------------------------------------
	| Config Client Fail Alert Text
	|--------------------------------------------------------------------------
	|
	| Here you can config the alert text when it failed in client.
	|
	*/
	'client_fail_alert' => 'Captcha is wrong!',

	/*
	|--------------------------------------------------------------------------
	| Config Server Fail Alert
	|--------------------------------------------------------------------------
	|
	| Here you can config the alert text when it failed in server (two factor validation).
	|
	*/
	'server_fail_alert' => 'Captcha is wrong!',


];