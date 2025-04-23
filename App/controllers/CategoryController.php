<?php
/**
 * Category Controller.
 *
 *
 *
 * Filename:        CategoryController.php
 * Location:        App/controllers
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    22/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 *
 */

namespace App\controllers;

use Framework\Database;
use Framework\Session;
use Framework\Validation;

class CategoryController
{
    /* Properties */

    /**
     * @var Database;
     */
    protected $db;

    /**
     * CategoryController constructor.
     *
     * Instantiate the database connection for the use in this class
     * storing the connection in the protected $db property.
     *
     * @throws \Exception;
     */
    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Categories home page
     *
     * @return void
     * @throws \Exception
     */
    public function index(): void
    {
        $categories = $this->db->query("SELECT * FROM categories")->fetchAll();

        loadView('categories/index', [
            'categories' => $categories
        ]);
    }

    /**
     * Search category by keywords
     *
     * @return void
     */
    public function search():void
    {
        $keywords = isset($_GET['keywords']) ? trim($_GET['keywords']) : '';

        /* Select each column from jokes, category name column and user nickname column using JOIN clause where jokes body matches keywords */
        $query = "SELECT * FROM categories WHERE name LIKE :keywords";

        $params = [
            'keywords' => "%{$keywords}%" // '%' represents zero, one, or multiple characters. To be used in conjunction with LIKE in query above.
        ];

        $categories = $this->db->query($query, $params)->fetchAll();

        loadView('/categories/index', [
            'keywords' => $keywords,
            'categories' => $categories
        ]);
    }

    /**
     * Show details of a category
     *
     * @return void
     */
    public function show(array $params):void
    {
        $id = $params['id'] ?? '';

        // Show detailed information about the selected category.
        $category_query = "SELECT categories.*, users.nickname AS author_name
                  FROM categories
                      JOIN users ON categories.user_id = users.id
                  WHERE categories.id = :id";

        $params = [
            'id' => $id
        ];

        $category = $this->db->query($category_query, $params)->fetch();

        // Get jokes under the specified category.
        $related_jokes = "SELECT jokes.id AS joke_id, jokes.title AS joke_title
                          FROM (jokes
                                JOIN categories ON jokes.category_id = categories.id)
                          WHERE categories.id = :id";

        $jokes = $this->db->query($related_jokes, $params)->fetchAll();

        loadView('/categories/show', [
            'category' => $category,
            'jokes' => $jokes
        ]);
    }

    /**
     * Edit category details
     * @param array $params
     * @return void
     */
    public function edit(array $params):void
    {
        $id = $params['id'] ?? '';

        $query = "SELECT * FROM categories WHERE id = :id";

        $params = [
            'id' => $id
        ];

        $category = $this->db->query($query, $params)->fetch();

        loadView('/categories/edit', [
            'category' => $category
        ]);
    }

    /**
     * Update category details
     * @param array $params
     * @return void
     */
    public function update(array $params):void
    {
        // Get category.
        $id = $params['id'] ?? null;

        $params = [
            'id' => $id
        ];

        $category = $this->db->query("SELECT * FROM categories WHERE id = :id", $params)->fetch();

        // Sanitize user input
        $title = sanitize($_POST['title']) ?? null;

        $errors = [];

        // Validate user input
        if(!Validation::string($title)) {
            $errors['title'] = 'Title cannot be blank!';
        }

        $params = [
            'name' => $title
        ];

        // Check if user input category already exists in DB.
        $contains_category = $this->db->query("SELECT name FROM categories WHERE name = :name", $params)->fetch();

        if($contains_category && !Validation::match($title, $category->name)) {
            $errors['title'] = "<strong>{$title}</strong> already exists in the system.";
        }

        if(!empty($errors)) {
            loadView("/categories/edit", [
                'errors' => $errors,
                'category' => $category
            ]);
            exit;
        }

        // Update in DB.
        $params = [
            'id' => $id,
            'title' => $title
        ];

        $this->db->query("UPDATE categories SET name = :title, updated_at = CURRENT_TIMESTAMP WHERE id = :id", $params);

        // Set flash message.
        Session::setFlashMessage('success_message', 'Category updated');

        redirect("/categories/{$id}");

    }

    /**
     * Load page to add new category.
     * @return void
     */
    public function create():void
    {

        loadView('/categories/create');

    }

    /**
     * Stores new category in DB.
     * @return void
     */
    public function store():void
    {
        // Get and sanitize submitted values.
        $title = sanitize($_POST['title']) ?? null;

        $errors = [];

        // Validate user input.
        if(!Validation::string($title)) {
            $errors['title'] = 'Title cannot be blank!';
        }

        $params = [
            'name' => $title
        ];

        // Check if user input category already exists in DB.
        $contains_category = $this->db->query("SELECT name FROM categories WHERE name = :name", $params)->fetch();

        if($contains_category) {
            $errors['title'] = "<strong>{$title}</strong> already exists in the system.";
        }

        if(!empty($errors)) {
            loadView('/categories/create', [
               'errors' => $errors,
            ]);
            exit;
        }

        // Store in DB.
        $params = [
            'user_id' => Session::get('user')['id'],
            'title' => $title
        ];

        $this->db->query("INSERT INTO categories (name, user_id, created_at) VALUES (:title, :user_id, CURRENT_TIMESTAMP)", $params);

        Session::setFlashMessage('success_message', 'Category successfully added!');

        redirect('/categories');
    }

    /**
     * Deletes a category from DB.
     * @return void
     */
    public function destroy(array $params):void
    {
        $id = $params['id'] ?? null;

        $params = [
            'id' => $id
        ];

        // Get category to announce in flash message.
        $category = $this->db->query("SELECT * FROM categories WHERE id = :id", $params)->fetch();

        Session::setFlashMessage('success_message', "You successfully deleted {$category->name}");

        // Delete category from DB.
        $this->db->query("DELETE FROM categories WHERE id = :id", $params);

        redirect('/categories');
    }

}