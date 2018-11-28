<?php

  // Time and error settings
  date_default_timezone_set("Europe/London");
  error_reporting(E_ALL);
  ini_set('display_errors', "on");

  // DB Params
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'shareposts');

  // App Root
  define('APPROOT', dirname(dirname(__FILE__)));
  // URL Root
  define('URLROOT', 'http://localhost/sharePost');
  // Site Name
  define('SITENAME', 'SharePosts');
  // App Version
  define('APPVERSION', '1.0.0');

  