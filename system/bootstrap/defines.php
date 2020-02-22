<?php

$URI         = $_SERVER['REQUEST_URI'];
$scriptName = $_SERVER['SCRIPT_NAME'];

# remove ? and # from URI
$URI = preg_replace('/(.*)\?(.*)/', "$1", $URI);
$URI = preg_replace('/(.*)\#(.*)/', "$1", $URI);

# remove index.php fromt DOCUMENT_URI
$scriptName = dirname($scriptName, 1);

# removes the first part from URI.
# that part is the folder before public
# if the DOCUMENT_URI is not '/', in others words,
# if the DOCUMENT_URI is not empty
if ($scriptName!=='/') {
    $URI = str_replace($scriptName, '', $URI);
}
# removes the first bar
$URI = trim($URI, '/');

# get the actual SCRIPT_FILENAME (e.g.: /home/.../site/public/index.php)
# and removes public/index.php from get path to this project
$PATH  = $_SERVER['SCRIPT_FILENAME'];
$PATH  = dirname($PATH, 2);
$PATH .= "/";

#
$SCHEME  = 'http';
$SCHEME .= isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on'? 's': '';

# lowered method
$REQUEST_METHOD = strtolower($_SERVER['REQUEST_METHOD']);

# get actual url
$BASE = "{$SCHEME}://{$_SERVER['SERVER_NAME']}{$scriptName}";
# adds a final bar if not contains
if ($BASE[strlen($BASE)-1] !== '/') {
    $BASE .= "/";
}

# this is the url base of this project
define('BASE',   $BASE);

# this is the PATH to this project
define('PATH', $PATH);

# this is the scheme of the project: http, https...
define('SCHEME', $SCHEME);

# this is the method of the project: get, post, put...
define('REQUEST_METHOD', $REQUEST_METHOD);

# this is the branch that someone is tryng to access:
# users, users/test, about...
# empty branch is like home route
define('BRANCH', $URI);
