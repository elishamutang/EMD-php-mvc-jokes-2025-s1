<?php
/**
 * Error Controller Class
 *
 * Provides the handling of 404, 403 and possibly expand to
 * other HTTP response codes.
 *
 * Filename:        ErrorController.php
 * Location:        App/controllers/
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    13/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 *
 */

namespace App\Controllers;

class ErrorController
{
    /**
     * 404 not found error
     *
     * Provides the error view with the 404 (not found) error code
     * and a suitable message.
     *
     * @param string $message an optional message string
     * @return void
     */
    public static function notFound($message = 'Resource not found')
    {
        http_response_code(404);

        loadView('error', [
            'status' => '404',
            'message' => $message
        ]);
    }

    /**
     * 403 unauthorized error
     *
     * Provides the error view with the status of 403
     * and a suitable message.
     *
     * @param string $message an optional message string
     * @return void
     */
    public static function unauthorized($message = 'You are not authorized to view this resource')
    {
        http_response_code(403);

        loadView('error', [
            'status' => '403',
            'message' => $message
        ]);
    }

}