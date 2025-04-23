<?php
/**
 * Validation class
 *
 * Provides basic validation of data including
 * - string
 * - email
 * - match two items of data
 *
 * Filename:        Validation.php
 * Location:        Framework/
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    03/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 *
 */

namespace Framework;

class Validation
{
    /**
     * Validate a string
     *
     * @param $value
     * @param int $min
     * @param float|int $max
     * @return bool
     */
    public static function string($value, int $min = 1, float|int $max = INF): bool
    {
        if (is_string($value)) {
            $value = trim($value);
            $length = strlen($value);
            return $length >= $min && $length <= floor($max);
        }

        return false;
    }


    /**
     * Validate email address
     *
     * Uses teh PHP filter_var function with the FILTER_VALIDATE_EMAIL
     * option. It is a bare essentials test that the email contains
     * the correct parts (MAILBOX@FQDN)
     *
     * @param string $value
     * @return mixed
     */
    public static function email(string $value): mixed
    {
        $value = trim($value);

        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }


    /**
     * Match a value against another
     * @param $value1
     * @param $value2
     * @return bool
     */
    public static function match($value1, $value2): bool
    {
        $value1 = trim($value1);
        $value2 = trim($value2);

        return $value1 === $value2;
    }

}