<?php

/**
 * Give a hashed string.
 * For now, this class is hashing by function 'password'.
 */
class Hash
{
    /**
     * Make a hashed string of 60 characters
     *
     * @param String $value
     * @return String
     */
    public static function make(String $value): String {
        return password_hash($value, PASSWORD_DEFAULT);
    }

    /**
     * Verify if the value is equals a hashed string
     *
     * @param String $value
     * @param String $verification
     * @return Bool
     */
    public static function verify(String $value, String $verification): Bool {
        return password_verify($value, $verification);
    }
}
