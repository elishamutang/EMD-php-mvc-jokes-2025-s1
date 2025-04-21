<?php
/**
 * Add Routes to Router
 *
 * Adds routes to the $router (instantiated in public/index.php)
 * to allow the calling of the appropriate method
 *
 * Filename:        routes.php
 * Location:        /
 * Project:         XXX-SaaS-Vanilla-MVC-YYYY-SN
 * Date Created:    20/08/2024
 *
 * Author:          Adrian Gould <Adrian.Gould@nmtafe.wa.edu.au>
 *
 */

$router->get('/', 'StaticPageController@index');

$router->get('/dashboard', 'HomeController@dashboard', ['auth']);
$router->get('/edit', 'HomeController@edit', ['auth']);
$router->get('/about', 'StaticPageController@about');

$router->get('/auth/register', 'UserController@create', ['guest']);
$router->get('/auth/login', 'UserController@login', ['guest']);

$router->post('/auth/register', 'UserController@store', ['guest']);
$router->post('/auth/logout', 'UserController@logout', ['auth']);
$router->post('/auth/login', 'UserController@authenticate', ['guest']);
$router->post('/edit', 'UserController@update');

$router->get('/jokes', 'JokeController@index', ['auth']);
$router->get('/jokes/search', 'JokeController@search');
$router->get('/jokes/create', 'JokeController@create', ['auth']);
$router->get('/jokes/{id}', 'JokeController@show');
$router->get('/jokes/edit/{id}', 'JokeController@edit', ['auth']);

$router->post('/jokes', 'JokeController@store', ['auth']);
$router->put('/jokes/{id}', 'JokeController@update', ['auth']);
$router->delete('/jokes/{id}', 'JokeController@destroy', ['auth']);

/**
 * Example Routes for a feature (Feature)
 *
 * $router->HTTP_METHOD('PATH', 'CONTROLLER_NAME@METHOD', OPTIONAL_MIDDLEWARE)
 *
 * PATH is based on the pluralised version of the FEATURE_NAME
 * CONTROLLER_NAME is usually in the form "NAME" in Pascal Case with Controller added
 * METHOD is the Controller Class method (function) that is called
 * OPTIONAL_MIDDLEWARE indicates if middleware is used for example to ensure a user is authenticated, or is a guest
 */
$router->get('/features', 'FeatureController@index');
$router->get('/features/create', 'FeatureController@create', ['auth']);
$router->get('/features/edit/{id}', 'FeatureController@edit', ['auth']);
$router->get('/features/search', 'FeatureController@search');
$router->get('/features/{id}', 'FeatureController@show');

$router->post('/features', 'FeatureController@store', ['auth']);
$router->put('/features/{id}', 'FeatureController@update', ['auth']);
$router->delete('/features/{id}', 'FeatureController@destroy', ['auth']);

/** 
 * Example Product Feature Routes 
 */
$router->get('/products', 'ProductController@index');
$router->get('/products/create', 'ProductController@create', ['auth']);
$router->get('/products/edit/{id}', 'ProductController@edit', ['auth']);
$router->get('/products/search', 'ProductController@search');
$router->get('/products/{id}', 'ProductController@show');

$router->post('/products', 'ProductController@store', ['auth']);
$router->put('/products/{id}', 'ProductController@update', ['auth']);
$router->delete('/products/{id}', 'ProductController@destroy', ['auth']);

/** 
 * Example Colours Feature Routes 
 */
$router->get('/colours', 'ColourController@index');
$router->get('/colours/create', 'ColourController@create', ['auth']);
$router->get('/colours/edit/{id}', 'ColourController@edit', ['auth']);
$router->get('/colours/search', 'ColourController@search');
$router->get('/colours/{id}', 'ColourController@show');

$router->post('/colours', 'ColourController@store', ['auth']);
$router->put('/colours/{id}', 'ColourController@update', ['auth']);
$router->delete('/colours/{id}', 'ColourController@destroy', ['auth']);