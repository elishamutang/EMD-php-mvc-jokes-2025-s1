<?php
/**
 * FILE TITLE GOES HERE
 *
 * DESCRIPTION OF THE PURPOSE AND USE OF THE CODE
 * MAY BE MORE THAN ONE LINE LONG
 * KEEP LINE LENGTH TO NO MORE THAN 96 CHARACTERS
 *
 * Filename:        Authorise.php
 * Location:
 * Project:         XXX-SaaS-Vanilla-MVC-YYYY-SN
 * Date Created:    20/08/2024
 *
 * Author:          Adrian Gould <Adrian.Gould@nmtafe.wa.edu.au>
 *
 */

namespace Framework\middleware;

use Framework\Session;

class Authorise
{
    /**
     * Handle the user's request
     *
     * @param string $role
     * @return bool
     */
    public function handle($role)
    {
        if ($role === 'guest' && $this->isAuthenticated()) {
            return redirect('/');
        }

        if ($role === 'auth' && !$this->isAuthenticated()) {
            return redirect('/auth/login');
        }
        return false;
    }


    /**
     * Check if user is authenticated
     *
     * @return bool
     */
    public function isAuthenticated()
    {
        return Session::has('user');
    }
}