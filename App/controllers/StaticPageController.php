<?php
/**
 * Static Page Controller.
 *
 * Directs user to static pages such as home, contact, and about page.
 *
 * Filename:        StaticPageController.php
 * Location:        App/controllers
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    13/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 *
 */


namespace App\controllers;

use Framework\Database;
use Framework\Session;
use Framework\Validation;

class StaticPageController
{
    /* Properties */

    /**
     * @var Database
     */
    protected $db;

    /**
     * StaticPageController Constructor
     *
     * Instantiate the database connection for use in this class
     * storing the connection in the protected $db property.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Directs user to homepage regardless if logged in or not.
     *
     * @return void
     */
    public function index()
    {
        $simpleRandomSixQuery = 'SELECT * FROM jokes ORDER BY RAND() LIMIT 0,1';

        $jokes = $this->db->query($simpleRandomSixQuery)->fetchAll();

        loadView('home', [
            'joke' => $jokes[0]
        ]);
    }

    /**
     * Directs user to about page regardless if logged in or not.
     *
     * @return void
     */
    public function about()
    {
        loadView('about');
    }

}