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
use Framework\Validation;

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
        /* Select each colum from jokes, category name column, and user nickname column using JOIN clause. */
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

    /**
     * Search jokes by keywords
     *
     * @return void
     */
    public function search():void
    {
        $keywords = isset($_GET['keywords']) ? trim($_GET['keywords']) : '';

        /* Select each column from jokes, category name column and user nickname column using JOIN clause where jokes body matches keywords */
        $query = "SELECT jokes.*, categories.name AS category_name, users.nickname AS author_nickname 
                  FROM ((jokes 
                      JOIN categories ON jokes.category_id = categories.id)
                      JOIN users ON jokes.author_id = users.id)
                  WHERE jokes.body LIKE :keywords";

        $params = [
            'keywords' => "%{$keywords}%" // '%' represents zero, one, or multiple characters. To be used in conjunction with LIKE in query above.
        ];

        $jokes = $this->db->query($query, $params)->fetchAll();

        loadView('/jokes/index', [
            'keywords' => $keywords,
            'jokes' => $jokes
        ]);
    }

    /**
     * Show details of a joke
     *
     * @return void
     */
    public function show(array $params):void
    {
        $id = $params['id'] ?? '';

        $query = "SELECT jokes.*, categories.name AS category_name, users.given_name AS author_given_name, users.family_name AS author_family_name 
                  FROM ((jokes 
                      JOIN categories ON jokes.category_id = categories.id)
                      JOIN users ON jokes.author_id = users.id)
                  WHERE jokes.id = :id";

        $params = [
            'id' => $id
        ];

        $joke = $this->db->query($query, $params)->fetch();

        loadView('/jokes/show', [
           'joke' => $joke,
        ]);
    }

    /**
     * Edit joke details
     * @param array $params
     * @return void
     */
    public function edit(array $params):void
    {
        $id = $params['id'] ?? '';

        $query = "SELECT jokes.*, categories.name AS category_name, users.given_name AS author_given_name, users.family_name AS author_family_name
                  FROM ((jokes
                      JOIN categories ON jokes.category_id = categories.id)
                      JOIN users ON jokes.author_id = users.id)
                  WHERE jokes.id = :id";

        $params = [
            'id' => $id
        ];

        $joke = $this->db->query($query, $params)->fetch();

        $categories = $this->db->query("SELECT name FROM categories")->fetchAll();

        loadView('/jokes/edit', [
            'categories' => $categories,
            'joke' => $joke
        ]);
    }

    /**
     * Update joke details
     * @param array $params
     * @return void
     */
    public function update(array $params):void
    {
        // Get submitted form value.
        $updated_fields = [
            'title' => $_POST['title'] ?? null,
            'body' => $_POST['body'] ?? null,
            'category_name' => $_POST['category_name'] ?? null,
            'tags' => $_POST['tags'] ?? null
        ];

        // Get joke.
        $id = $params['id'] ?? null;

        $params = [
            'id' => $id
        ];

        $query = "SELECT * FROM jokes WHERE id = :id";

        $joke = $this->db->query($query, $params)->fetch();

        // Store any input errors.
        $errors = [];

        // Validate user input.
        // Title cannot be empty.
        if(!Validation::string($updated_fields['title'])) {
            $errors['title'] = 'Please enter a title.';
        }

        // Body cannot be empty.
        if(!Validation::string($updated_fields['body'])) {
            $errors['body'] = 'Please enter your joke.';
        }

        // No duplicate tags allowed.
        $current_tags = explode(',', $joke->tags);
        $new_tags = array_diff($current_tags, $updated_fields['tags']);

        if(!empty($new_tag)) {
            $current_tags = array_merge($current_tags, $new_tags);
        }


    }
}