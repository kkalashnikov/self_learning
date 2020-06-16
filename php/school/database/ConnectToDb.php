<?php


class ConnectToDb {

  /**
   * ConnectToDatabase constructor.
   */
  public function __construct() {
    include_once dirname(__DIR__) . '/config/config.php';
  }

  public function connectToDatabase() {
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

    // Check connection
    if ($mysqli -> connect_errno) {
      echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
      exit();
    }
    return $mysqli;
  }

}