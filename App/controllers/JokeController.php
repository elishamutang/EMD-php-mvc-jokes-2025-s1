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
use Framework\Session;
use League\HTMLToMarkdown\HtmlConverter;
use League\CommonMark\CommonMarkConverter;

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

        $joke_query = "SELECT jokes.*, categories.name AS category_name, users.given_name AS author_given_name, users.family_name AS author_family_name
                  FROM ((jokes
                      JOIN categories ON jokes.category_id = categories.id)
                      JOIN users ON jokes.author_id = users.id)
                  WHERE jokes.id = :id";

        $joke = $this->db->query($joke_query, $params)->fetch();

        // Get submitted form values.
        $updated_fields = [
            'title' => sanitize($_POST['title']) ?? null,
            'body' => $_POST['description'] ?? null,
            'category' => $_POST['category'] ?? null,
            'tags' => sanitize($_POST['tags']) ?? null
        ];

        // Get updated category id
        $category_id = $this->db->query("SELECT id FROM categories WHERE name = :name", ['name' => $updated_fields['category']])->fetch();

        // Convert joke description from HTML to markdown to get text only.
        $converter = new HtmlConverter();
        $updated_fields['body'] = $converter->convert($updated_fields['body']);

        $categories_query = "SELECT * FROM categories";
        $categories = $this->db->query($categories_query)->fetchAll();

        // Store any input errors.
        $errors = [];

        /*
         * Validation
         * Joke title, body, and tags cannot be left empty.
         * Prevent duplicates for joke title.
         */
        if(!Validation::string($updated_fields['title'])) {
            $errors['title'] = 'Title cannot be blank!';
        }

        if(!Validation::string($updated_fields['body'])) {
            $errors['description'] = 'Body cannot be blank!';
        }

        if(!Validation::string($updated_fields['tags'])) {
            $errors['tags'] = 'Tags must contain at least 1 tag.';
        }

        $params = [
            'title' => $updated_fields['title']
        ];

        // Check if user input title already exists in DB.
        $contains_title = $this->db->query("SELECT title FROM jokes WHERE title = :title", $params)->fetch();

        if($contains_title && !Validation::match($joke->title, $updated_fields['title'])) {
            $errors['title'] = "<strong>{$updated_fields['title']}</strong> already exists in the system.";
        }

        // Re-load edit page with joke details and error message(s) if any.
        if(!empty($errors)) {
            loadView('/jokes/edit', [
                'joke' => $joke,
                'errors' => $errors,
                'categories' => $categories
            ]);
            exit;
        }

        // Convert joke description from markdown to HTML entities to store in DB. Joke description is already
        // sanitized hence no need to run sanitize() here.
        $markdown_converter = new CommonMarkConverter();
        $updated_fields['body'] = htmlentities($markdown_converter->convert($updated_fields['body']), ENT_COMPAT);

        // Prepare to update tags.
        $input_tags = str_replace(' ', '', trim($updated_fields['tags']));
        $input_tags_arr = explode(',', $input_tags);

        // Get unique values only
        $input_tags_unique = array_unique($input_tags_arr);

        // Update tags.
        $updated_fields['tags'] = implode(',', $input_tags_unique);

        $params = [
            'id' => $id,
            'title' => $updated_fields['title'],
            'body' => $updated_fields['body'],
            'category' => $category_id->id,
            'tags' => $updated_fields['tags']
        ];

        // Update joke details in database.
        $update_query = "UPDATE jokes SET title = :title, body = :body, category_id = :category, tags = :tags WHERE id = :id";
        $this->db->query($update_query, $params);

        // Set flash message.
        Session::setFlashMessage('success_message', 'Joke updated');

        redirect("/jokes/{$id}");

    }

    /**
     * Load page to add new joke.
     * @return void
     */
    public function create():void
    {
        // Get all categories
        $categories = $this->db->query("SELECT * FROM categories")->fetchAll();

        loadView('/jokes/create', [
            'categories' => $categories
        ]);
    }

    /**
     * Stores new joke in DB.
     * @return void
     * @throws \League\CommonMark\Exception\CommonMarkException
     */
    public function store():void
    {
        // Get submitted values.
        $title = sanitize($_POST['title']) ?? null;
        $author = sanitize($_POST['name']) ?? null;
        $body = $_POST['description'] ?? null;
        $category = $_POST['category'] ?? null;
        $tags = sanitize($_POST['tags']) ?? null;

        // Get all categories
        $categories = $this->db->query("SELECT * FROM categories")->fetchAll();

        // Errors
        $errors = [];

        // Convert joke description from HTML to markdown to get text only.
        $converter = new HtmlConverter();
        $body = $converter->convert($body);

        /*
         * Validation
         * Joke title, author, body, and tags cannot be left empty.
         */
        if(!Validation::string($title)) {
            $errors['title'] = 'Title cannot be blank!';
        }

        if(!Validation::string($author)) {
            $errors['author'] = 'Author name cannot be blank!';
        }

        if(!Validation::string($body)) {
            $errors['description'] = 'Body cannot be blank!';
        }

        if(!Validation::string($tags)) {
            $errors['tags'] = 'Tags must contain at least 1 tag.';
        }

        $params = [
            'title' => $title
        ];

        // Check if user input title already exists in DB.
        $contains_title = $this->db->query("SELECT title FROM jokes WHERE title = :title", $params)->fetch();

        if($contains_title) {
            $errors['title'] = "<strong>{$title}</strong> already exists in the system.";
        }

        // Re-load create form if $errors array is not empty.
        if(!empty($errors)) {
            loadView('/jokes/create', [
                'errors' => $errors,
                'categories' => $categories,
                'joke' => [
                    'title' => $title,
                    'author' => $author,
                    'body' => $body,
                    'category' => $category,
                    'tags' => $tags
                ]
            ]);
            exit;
        }

        // Get category id
        $category_id = $this->db->query("SELECT id FROM categories WHERE name = :name", ['name' => $category])->fetch();

        // Transform joke body back to HTML and subsequently to its HTML entities to store in DB.
        $markdown_converter = new CommonMarkConverter();
        $body = htmlentities($markdown_converter->convert($body)->getContent(), ENT_COMPAT);

        // Add joke to database.
        $params = [
            'title' => $title,
            'author' => Session::get('user')['id'],
            'body' => $body,
            'category_id' => $category_id->id,
            'tags' => $tags
        ];

        $query = "INSERT INTO jokes (title, body, category_id, tags, author_id) VALUES (:title, :body, :category_id, :tags, :author)";

        Session::setFlashMessage('success_message', 'Joke successfully added!');

        $this->db->query($query, $params);

        redirect('/jokes');
    }

    /**
     * Deletes a joke from DB.
     * @return void
     */
    public function destroy(array $params):void
    {
        $id = $params['id'] ?? null;

        $params = [
            'id' => $id
        ];

        // Get joke to announce in flash message.
        $joke = $this->db->query("SELECT * FROM jokes WHERE id = :id", $params)->fetch();

        Session::setFlashMessage('success_message', "You successfully deleted {$joke->title}");

        // Delete joke from DB.
        $this->db->query("DELETE FROM jokes WHERE id = :id", $params);

        redirect('/jokes');
    }
}