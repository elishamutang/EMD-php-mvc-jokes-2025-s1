<?php
/**
 * Add Routes to Router
 *
 * Adds routes to the $router (instantiated in public/index.php)
 * to allow the calling of the appropriate method
 *
 * Filename:        routes.php
 * Location:        /
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    13/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 *
 */

$router->get('/', 'StaticPageController@index');
$router->get('/about', 'StaticPageController@about');
$router->get('/edit', 'UserController@edit', ['auth']);

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

$router->get('/categories', 'CategoryController@index', ['auth']);
$router->get('/categories/search', 'CategoryController@search', ['auth']);
$router->get('categories/create', 'CategoryController@create', ['auth']);
$router->get('/categories/edit/{id}', 'CategoryController@edit', ['auth']);
$router->get('/categories/{id}', 'CategoryController@show', ['auth']);

$router->post('/categories', 'CategoryController@store', ['auth']);
$router->put('/categories/{id}', 'CategoryController@update', ['auth']);
$router->delete('/categories/{id}', 'CategoryController@destroy', ['auth']);