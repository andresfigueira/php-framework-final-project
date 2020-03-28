<?php

// Database
require(ROOT . '/config/database.php');

// Constants
require(ROOT . '/config/constants.php');

// Error handling
ini_set('error_reporting', 'true');
error_reporting(E_ALL & ~E_NOTICE);
