<?php
/**
 * Home Controller
 *
 * Directs user to home, dashboard or edit details page.
 *
 * Filename:        HomeController.php
 * Location:        App/controllers
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    04/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 *
 */

namespace App\Controllers;


use Framework\Database;
use Framework\Session;

class HomeController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /*
     * Show the latest jokes
     *
     * @return void
     */
    public function index()
    {
        $simpleRandomSixQuery = 'SELECT * FROM jokes ORDER BY RAND() LIMIT 0,1';

        $jokes = $this->db->query($simpleRandomSixQuery)
            ->fetchAll();


        loadView('home', [
            'joke' => $jokes[0]
        ]);
    }

    /*
     * Show the latest jokes
     *
     * @return void
     */
    public function dashboard()
    {
        $lastSixQuery = 'SELECT * FROM jokes ORDER BY created_at DESC LIMIT 0,6';
        $simpleRandomSixQuery = 'SELECT * FROM jokes ORDER BY RAND() LIMIT 0,6';

        $jokes = $this->db->query($simpleRandomSixQuery)
            ->fetchAll();

        $jokesCount = $this->db->query('SELECT count(id) as total FROM jokes ')
            ->fetch();

        $userCount = $this->db->query('SELECT count(id) as total FROM users')
            ->fetch();

        $user = Session::get('user');

        loadView('dashboard', [
            'user' => $user,
            'jokes' => $jokes,
            'jokesCount' => $jokesCount,
            'userCount' => $userCount,
        ]);
    }

    /*
     * Allow user to edit their personal details.
     *
     * @return void
     */
    public function edit()
    {
        $user = Session::get('user');

        loadView('/users/edit', [
           'user' => $user
        ]);
    }

}