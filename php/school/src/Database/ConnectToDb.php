<?php

namespace Database;

class ConnectToDb {

  /**
   * ConnectToDatabase constructor.
   */
  public function __construct() {
    include_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
  }

  /**
   * Connect to database method.
   *
   * @return
   *   Database object.
   */
  public function connectToDatabase() {
    $mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

    // Check connection
    if ($mysqli -> connect_errno) {
      echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
      exit();
    }
    return $mysqli;
  }

}