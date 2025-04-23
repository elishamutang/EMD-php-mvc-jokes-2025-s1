<?php
/**
 * User Controller
 *
 * Provides the Register, Login and Logout capabilities
 * of the application
 *
 * Filename:        UserController.php
 * Location:        App/Controllers
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    04/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 *
 */

namespace App\Controllers;

use Framework\Database;
use Framework\Session;
use Framework\Validation;

class UserController
{

    /* Properties */

    /**
     * @var Database
     */
    protected $db;

    /**
     * UserController Constructor
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
     * Show the login page
     *
     * @return void
     */
    public function login()
    {
        loadView('users/login');
    }

    /**
     * Show the register page
     *
     * @return void
     */
    public function create()
    {
        loadView('users/create');
    }

    /**
     * Store user in database
     *
     * @return void
     */
    public function store()
    {
        $given_name = $_POST['given_name'] ?? null;
        $family_name = $_POST['family_name'] ?? null;
        $nickname = empty($_POST['nickname']) ? $given_name : $_POST['nickname'];
        $email = $_POST['email'] ?? null;
        $city = empty($_POST['city']) ? 'Unknown' : $_POST['city'];
        $state = empty($_POST['state']) ? 'Unknown' : $_POST['state'];
        $country = empty($_POST['country']) ? 'Unknown' : $_POST['country'];
        $password = $_POST['password'] ?? null;
        $passwordConfirmation = $_POST['password_confirmation'] ?? null;

        $errors = [];

        // Validation
        if (!Validation::email($email)) {
            $errors['email'] = 'Please enter a valid email address';
        }

        if (!Validation::string($given_name, 2, 50)) {
            $errors['given_name'] = 'Given name must be between 2 and 50 characters';
        }

        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = 'Password must be at least 6 characters';
        }

        if (!Validation::match($password, $passwordConfirmation)) {
            $errors['password_confirmation'] = 'Passwords do not match';
        }

        if (!empty($errors)) {
            loadView('users/create', [
                'errors' => $errors,
                'user' => [
                    'given_name' => $given_name,
                    'family_name' => $family_name,
                    'nickname' => $nickname,
                    'email' => $email,
                    'city' => $city,
                    'state' => $state,
                    'country' => $country
                ]
            ]);
            exit;
        }

        // Check if email exists
        $params = [
            'email' => $email
        ];

        $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

        if ($user) {
            $errors['email'] = 'That email already exists, please log in.';
            loadView('users/create', [
                'errors' => $errors
            ]);
            exit;
        }

        // Create user account
        $params = [
            'given_name' => $given_name,
            'family_name' => $family_name,
            'nickname' => $nickname,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'city' => $city,
            'state' => $state,
            'country' => $country,
        ];

        $this->db->query('INSERT INTO users (given_name, family_name, nickname, email, password, city, state, country, created_at) 
                                VALUES (:given_name, :family_name, :nickname, :email, :password, :city, :state, :country, CURRENT_TIMESTAMP)', $params);

        // Get new user ID
        $userId = $this->db->conn->lastInsertId();

        // Set user session
        Session::set('user', [
            'id' => $userId,
            'given_name' => $given_name,
            'family_name' => $family_name,
            'nickname' => $nickname,
            'email' => $email,
            'city' => $city,
            'state' => $state,
            'country' => $country
        ]);

        redirect('/');
    }

    /**
     * Allow user to edit their personal details.
     *
     * @return void
     */
    public function edit():void
    {
        $user = Session::get('user');

        loadView('/users/edit', [
            'user' => $user
        ]);
    }

    /**
     * Update user details.
     *
     * @return void
     */
    public function update():void
    {
        // Get current user
        $user = Session::get('user');

        $given_name = $_POST['given_name'] ?? null;
        $family_name = $_POST['family_name'] ?? null;
        $nickname = empty($_POST['nickname']) ? $given_name : $_POST['nickname'];
        $email = $_POST['email'] ?? null;
        $city = empty($_POST['city']) ? 'Unknown' : $_POST['city'];
        $state = empty($_POST['state']) ? 'Unknown' : $_POST['state'];
        $country = empty($_POST['country']) ? 'Unknown' : $_POST['country'];
        $password = $_POST['password'] ?? null;
        $passwordConfirmation = $_POST['password_confirmation'] ?? null;

        $errors = [];

        // Validation
        if (!Validation::email($email)) {
            $errors['email'] = 'Please enter a valid email address';
        }

        if (!Validation::string($given_name, 2, 50)) {
            $errors['given_name'] = 'Given name must be between 2 and 50 characters';
        }

        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = 'Password must be at least 6 characters';
        }

        if (!Validation::match($password, $passwordConfirmation)) {
            $errors['password_confirmation'] = 'Passwords do not match';
        }

        if (!empty($errors)) {
            loadView('users/edit', [
                'errors' => $errors,
                'user' => [
                    'given_name' => $given_name,
                    'family_name' => $family_name,
                    'nickname' => $nickname,
                    'email' => $email,
                    'city' => $city,
                    'state' => $state,
                    'country' => $country
                ]
            ]);
            exit;
        }

        // Check if email entered is already registered.
        $params = [
            'email' => $email
        ];

        $existing_user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

        // Allows current user to maintain current email without raising error.
        if ($existing_user && !Validation::match((string) $existing_user -> id, $user['id'])) {
            $errors['email'] = 'Email is already registered.';
            loadView('users/edit', [
                'errors' => $errors,
                'user' => [
                    'given_name' => $given_name,
                    'family_name' => $family_name,
                    'nickname' => $nickname,
                    'city' => $city,
                    'state' => $state,
                    'country' => $country
                ]
            ]);
        }

        // Update user details
        $params = [
            'id' => $user['id'],
            'given_name' => $given_name,
            'family_name' => $family_name,
            'nickname' => $nickname,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'city' => $city,
            'state' => $state,
            'country' => $country,
        ];

        $this->db->query('UPDATE users SET given_name = :given_name, family_name = :family_name, nickname = :nickname, email = :email, 
                                password = :password, city = :city, state = :state, country = :country, updated_at = CURRENT_TIMESTAMP WHERE id = :id', $params);

        Session::set('user', [
            'id' => $user['id'],
            'given_name' => $given_name,
            'family_name' => $family_name,
            'nickname' => $nickname,
            'email' => $email,
            'city' => $city,
            'state' => $state,
            'country' => $country
        ]);

        // Set flash message
        Session::setFlashMessage('success_message', 'Details updated');

        redirect('/edit');

    }


    /**
     * Logout a user and kill session
     *
     * @return void
     */
    public function logout()
    {
        Session::clearAll();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);

        redirect('/auth/login');
    }

    /**
     * Authenticate a user with email and password
     *
     * @return void
     */
    public function authenticate()
    {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        $errors = [];

        // Validation
        if (!Validation::email($email)) {
            $errors['email'] = 'Please enter a valid email';
        }

        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = 'Password must be at least 6 characters';
        }

        // Check for errors
        if (!empty($errors)) {
            loadView('users/login', [
                'errors' => $errors,
                'email' => $email
            ]);
            exit;
        }

        $params = [
            'email' => $email
        ];

        $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

        // Check if user exists
        if(!$user) {
            $errors['email'] = 'Email is not registered.';
        } else {
            // Incorrect email.
            if(!Validation::match($user->email, $email)) {
                $errors['email'] = 'Incorrect credentials';
            }

            // Check if password is correct
            if (!password_verify($password, $user->password)) {
                $errors['email'] = 'Incorrect credentials';
            }
        }

        if(!empty($errors)) {
            loadView('users/login', [
                'errors' => $errors
            ]);
            exit;
        }

        // Set user session
        Session::set('user', [
            'id' => $user->id,
            'given_name' => $user->given_name,
            'family_name' => $user->family_name,
            'nickname' => $user->nickname,
            'email' => $user->email,
            'city' => $user->city,
            'state' => $user->state,
            'country' => $user->country
        ]);

        redirect('/');
    }
}