<?php

/**
 * If the APP_ENV is not production, then display errors
 */
if (getenv('APP_ENV')!=='production') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

