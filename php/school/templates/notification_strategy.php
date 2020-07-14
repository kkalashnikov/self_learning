<?php

use Model\Strategy\StrategyContext;
use Model\Strategy\Email;
use Model\Strategy\Whatsapp;
use Model\Strategy\Facebook;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Notification</title>
</head>

<body>
  <?php
    $data = [
      'name' =>'Kunal Gautam',
      'email' => 'kunal@gmail.com',
      'number' => '9876543210'
    ];

    $context = new StrategyContext(new Email);
    echo "Client: Strategy is set to Email.\n";
    $context->default($data);

    echo "\n";

    echo "Client: Strategy is set to Whatsapp message.\n";
    $context  = new StrategyContext(new Whatsapp);
    $context->default($data);

    echo "\n";

    echo "Client: Strategy is set to Facebook message.\n";
    $context = new StrategyContext(new Facebook);
    $context->default($data);
  ?>

</body>

</html>