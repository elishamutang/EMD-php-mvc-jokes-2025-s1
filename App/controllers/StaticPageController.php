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
    public function index():void
    {
        $simpleRandomSixQuery = 'SELECT * FROM jokes ORDER BY RAND() LIMIT 0,1';
        $jokes_count = "SELECT COUNT(id) AS jokes_count FROM jokes";

        $jokes = $this->db->query($simpleRandomSixQuery)->fetchAll();
        $jokes_count = $this->db->query($jokes_count)->fetchAll();
        $user = Session::get('user');

        loadView('home', [
            'joke' => $jokes ? $jokes[0] : null,
            'jokes_count' => $jokes_count[0]->jokes_count,
            'user' => $user
        ]);
    }

    /**
     * Directs user to about page regardless if logged in or not.
     *
     * @return void
     */
    public function about():void
    {
        loadView('about');
    }

}