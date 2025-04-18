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
use League\HTMLToMarkdown\HtmlConverter;

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

        $query = "SELECT jokes.*, users.given_name AS author_given_name, users.family_name AS author_family_name
                  FROM ((jokes
                      JOIN categories ON jokes.category_id = categories.id)
                      JOIN users ON jokes.author_id = users.id)
                  WHERE jokes.id = :id";

        $params = [
            'id' => $id
        ];

        $joke = $this->db->query($query, $params)->fetch();

        $categories = $this->db->query("SELECT * FROM categories")->fetchAll();

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
        // Get joke.
        $id = $params['id'] ?? null;

        $params = [
            'id' => $id
        ];

        $joke_query = "SELECT * FROM jokes WHERE id = :id";
        $joke = $this->db->query($joke_query, $params)->fetch();

        // Get submitted form values.
        $updated_fields = [
            'title' => $_POST['title'] ?? null,
            'body' => $_POST['description'] ?? null,
            'category' => $_POST['category'] ?? null,
            'tags' => $_POST['tags'] ?? null
        ];

        // Convert joke description from HTML to markdown to get text only.
        $converter = new HtmlConverter();
        $updated_fields['body'] = $converter->convert($updated_fields['body']);

        $categories_query = "SELECT * FROM categories";
        $categories = $this->db->query($categories_query)->fetchAll();

        // Store any input errors.
        $errors = [];

        // Validate user input.
        // Title cannot be empty.
        if(!Validation::string($updated_fields['title'])) {
            $errors['title'] = 'Title cannot be blank!';
        }

        // Description cannot be empty.
        if(!Validation::string($updated_fields['body'])) {
            $errors['description'] = 'Body cannot be blank!';
        }

        // Re-load edit page with joke details and error message if title or description is blank.
        if(!empty($errors)) {
            loadView('/jokes/edit', [
                'joke' => $joke,
                'errors' => $errors,
                'categories' => $categories
            ]);
            exit;
        }

        // Prepare to update tags.
        $current_tags = explode(',', $joke->tags);
        $input_tags = trim($updated_fields['tags']);

        $updated_tags = empty($input_tags) ? $current_tags : explode(',', $input_tags);

        // No duplicate tags allowed.
        $new_tags = array_diff($updated_tags, $current_tags);

        if(!empty($new_tags)) {
            $updated_fields['tags'] = implode(',', array_merge($current_tags, $new_tags));
        } else {
            $updated_fields['tags'] = $joke->tags;
        }

        $params = [
            'id' => $id,
            'title' => $updated_fields['title'],
            'body' => $updated_fields['body'],
            'tags' => $updated_fields['tags']
        ];

        // Update in database
        $update_query = "UPDATE jokes SET title = :title, body = :body, tags = :tags WHERE id = :id";
        $this->db->query($update_query, $params);

        loadView('/jokes/edit', [
            'joke' => $joke,
            'categories' => $categories,
            'updated_fields' => $updated_fields,
            'updated_tags' => $updated_tags
        ]);


    }
}