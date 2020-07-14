<?php
//print_r($_SERVER['DOCUMENT_ROOT'].'/src/Model/Email.php'); die;
// include_once($_SERVER['DOCUMENT_ROOT'].'/src/Model/Strategy/Email.php');
// include_once($_SERVER['DOCUMENT_ROOT'].'/src/Model//Strategy/Whatsapp.php');
// include_once($_SERVER['DOCUMENT_ROOT'].'/src/Model//Strategy/Facebook.php');
// include_once($_SERVER['DOCUMENT_ROOT'].'/src/Model//Strategy/StrategyContext.php');

include_once $_SERVER['DOCUMENT_ROOT'] . '/autoload.php';
//print_r($_SERVER['DOCUMENT_ROOT'] .'/autoload.php'); die;

//header('Location: /templates/school_list.php');

/**
 * The client code picks a concrete strategy and passes it to the context. The
 * client should be aware of the differences between strategies in order to make
 * the right choice.
 */
// $data = [
//     'name' =>'Kunal Gautam',
//     'email' => 'kunal@gmail.com',
//     'number' => '9876543210'
// ];
// $context = new Context(new Email);
// echo "Client: Strategy is set to Email.\n";
// $context->default($data);

// echo "\n";

// echo "Client: Strategy is set to Whatsapp message.\n";
// $context  = new Context(new Whatsapp);
// $context->default($data);

// echo "\n";

// echo "Client: Strategy is set to Facebook message.\n";
// $context = new Context(new Facebook);
// $context->default($data);

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