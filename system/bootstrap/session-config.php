<?php

session_start();

if (!isset($_SESSION['OfirSecuritySessionVerify'])) {
    session_regenerate_id(true);
    $_SESSION['OfirSecuritySessionVerify'] = time();
}

if ($_SESSION['OfirSecuritySessionVerify'] < time() - 300) {
    session_regenerate_id(true);
    $_SESSION['OfirSecuritySessionVerify'] = time();
}
