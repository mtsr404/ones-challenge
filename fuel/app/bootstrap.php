<?php
// Bootstrap the framework DO NOT edit this
require COREPATH.'bootstrap.php';

\Autoloader::add_classes(array(
	// Add classes you want to override here
	// Example: 'View' => APPPATH.'classes/view.php',
));

// Register the autoloader
\Autoloader::register();

/**
 * Your environment.  Can be set to any of the following:
 *
 * Fuel::DEVELOPMENT
 * Fuel::TEST
 * Fuel::STAGING
 * Fuel::PRODUCTION
 */

switch (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '') {
	case 'fuku-job.jp':
		Fuel::$env = Fuel::PRODUCTION;
		break;

	case 'stage.fuku-job.jp':
		Fuel::$env = Fuel::STAGING;
		break;

	case '52.25.218.97':
		Fuel::$env = Fuel::TEST;
		break;

	case 'mtsr.fuku-job.jp':
		Fuel::$env = Fuel::TEST;
		break;

	default:
		Fuel::$env = Fuel::DEVELOPMENT;
		break;
}

// Initialize the framework with the config file.
\Fuel::init('config.php');
