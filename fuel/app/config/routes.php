<?php
return array(
	'_root_'  => 'welcome', // Root (Web Module)
	'_404_'   => '404',    // The main 404 route

	/**
	 * Modules
	 *
	 * モジュールを追加したらここも追加する
	 *
	 */
	'api/(:any)'  => 'api/$1',
	'table/(:any)' => 'table/$1',
);
