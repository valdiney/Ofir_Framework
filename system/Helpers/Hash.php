<?php

class Hash
{
    public static function make($password = null) {
        $salt = "dfddfdfddfd;dfdfd45654;df45541254sdsdw";
        $unic_salt = "asweq451";
        return sha1($password.$salt.$unic_salt);
    }
}
