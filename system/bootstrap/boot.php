<?php

# configures PHP displayng errors
require_once("config-display-erros.php");

# includes the file responsible for load .env file
require_once("enviroments.php");

# configures timezone for Ofir
require_once("config-timezone.php");

# configures session security
require_once("session-config.php");

# includes the file resposible for define initial consts
require_once("defines.php");

# init the Routing
Route::init();

# initialize the Brain\Core
Core::init();
