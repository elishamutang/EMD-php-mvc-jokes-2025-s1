<?php
/**
 * Joke Controller.
 *
 * Basic BREAD (browse, read, edit, add, delete) operations plus search and random joke.
 *
 * Filename:        JokeController.php
 * Location:        App/controllers
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    13/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 *
 */


namespace App\controllers;

use Framework\Database;

class JokeController
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
     * Jokes home page
     *
     * @return void
     * @throws \Exception
     */
    public function index(): void
    {
        /* Load jokes along with category name. */
        $sql = "SELECT jokes.*, categories.name AS category_name, users.nickname AS author_nickname 
                FROM ((jokes 
                    JOIN categories ON jokes.category_id = categories.id)
                    JOIN users ON jokes.author_id = users.id)
                ORDER BY created_at DESC";

        $jokes = $this->db->query($sql)->fetchAll();

        loadView('jokes/index', [
            'jokes' => $jokes
        ]);
    }

}