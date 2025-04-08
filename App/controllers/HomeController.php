<?php
/**
 * FILE TITLE GOES HERE
 *
 * DESCRIPTION OF THE PURPOSE AND USE OF THE CODE
 * MAY BE MORE THAN ONE LINE LONG
 * KEEP LINE LENGTH TO NO MORE THAN 96 CHARACTERS
 *
 * Filename:        HomeController.php
 * Location:
 * Project:         XXX-SaaS-Vanilla-MVC-YYYY-SN
 * Date Created:    20/08/2024
 *
 * Author:          Adrian Gould <Adrian.Gould@nmtafe.wa.edu.au>
 *
 */

namespace App\Controllers;


use Framework\Database;

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

        $productCount = $this->db->query('SELECT count(id) as total FROM jokes ')
            ->fetch();

        $userCount = $this->db->query('SELECT count(id) as total FROM users')
            ->fetch();

        loadView('dashboard', [
            'jokes' => $jokes,
            'productCount' => $productCount,
            'userCount' => $userCount,
        ]);
    }



}