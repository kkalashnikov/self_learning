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
    echo "<b>Client: Strategy is set to Email.</b><br>";
    $context->default($data);

    echo "<br><br>";

    echo "<b>Client: Strategy is set to Whatsapp message.</b><br>";
    $context  = new StrategyContext(new Whatsapp);
    $context->default($data);

    echo "<br><br>";

    echo "<b>Client: Strategy is set to Facebook message.</b><br>";
    $context = new StrategyContext(new Facebook);
    $context->default($data);
  ?>

</body>

</html>