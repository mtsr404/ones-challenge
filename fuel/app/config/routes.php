<?php
return array(
	'_root_'  => 'web/landing', // Root (Web Module)
	'_404_'   => '404',    // The main 404 route

	/**
	 * Modules
	 *
	 * モジュールを追加したらここも追加する
	 *
	 */
	'web'  => 'web/landing',
	'web/(:any)'  => 'web/$1',
	'api/(:any)'  => 'api/$1',
	'admin/(:any)'  => 'admin/$1',
	'sandbox/(:any)'  => 'sandbox/$1',
	'table/(:any)' => 'table/$1',

	// モジュール名を含まない場合はwebモジュールへ
	'(:any)'  => 'web/$1',

);
