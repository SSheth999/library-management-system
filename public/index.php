<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014-2019 British Columbia Institute of Technology
 * Copyright (c) 2019-2023 CodeIgniter Foundation
 *
 * @package    CodeIgniter
 * @author     CodeIgniter Dev Team
 * @copyright  2019-2023 CodeIgniter Foundation
 * @license    https://opensource.org/licenses/MIT	MIT License
 * @link       https://codeigniter.com
 * @since      Version 4.0.0
 * @filesource
 */

// Path to the front controller
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Ensure the current directory is pointing to the front controller's directory
chdir(FCPATH);

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 * This process sets up the path constants, loads and registers
 * our autoloader, along with Composer's, loads our constants
 * and fires up an environment-specific bootstrapping.
 */

// Load our paths config file
// This is the line that might differ from the default setup
require FCPATH . '../app/Config/Paths.php';

$paths = new Config\Paths();

// Location of the framework bootstrap file.
require rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';

// Load environment settings from .env file into $_SERVER and $_ENV
require_once SYSTEMPATH . 'Config/DotEnv.php';
(new CodeIgniter\Config\DotEnv(ROOTPATH))->load();

// Always restore error handlers
if (defined('SUPPRESS_ERROR_HANDLING') && SUPPRESS_ERROR_HANDLING)
{
	// Do nothing, handled by Docker
}
else
{
	set_error_handler(new \CodeIgniter\Debug\ExceptionHandler());
	set_exception_handler(new \CodeIgniter\Debug\ExceptionHandler());
}

// Use Composer's autoloader
$loader = require rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

// Set environment
define('ENVIRONMENT', $_ENV['CI_ENVIRONMENT'] ?? 'production');

// Load environment-specific configuration
$app = require rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'Config/Boot/' . ENVIRONMENT . '.php';

// Run the application
$app->run();

