<?php
/**
 * Public facing index page
 *
 * Performs the bootstrapping of the application by
 * - autoloading the classes
 * - requiring the helper functions
 * - creating a list of routes
 * - parsing the URI 
 * - calling the relevant method based on the route requested
 *
 * Filename:        index.php
 * Location:        public/
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    03/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 *
 */

require __DIR__ . '/../vendor/autoload.php';

use Framework\Router;
use Framework\Session;

Session::start();

require '../helpers.php';

// Instantiate the router
$router = new Router();

// Get routes
$routes = require basePath('routes.php');

// Get current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//echo password_hash("Password1",PASSWORD_DEFAULT);
//die;
// Route the request
$router->route($uri);
