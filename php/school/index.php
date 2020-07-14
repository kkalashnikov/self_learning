<?php
include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/autoload.php';

// Create a new router instance.
$router = new Routes\Router($_SERVER);
// Prepare routes array.
$routes = [
  '' => 'templates/school_list.php',
  'school-list' => 'templates/school_list.php',
  'school-mapping' => 'templates/school_mapping.php',
  'student-registration' => 'templates/student_registration.php',
  'notification' => 'templates/notification_strategy.php',
];
$router->prepareRoutes($routes);


?>