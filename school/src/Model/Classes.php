<?php

include('School.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/database/ConnectToDb.php');

/**
 * Provides listings.
 */
class Classes extends School {


  private $id;

  private $connection;

  /**
   * Student constructor.
   */
  function __construct() {
    // Connecting to database.
    $connection = new ConnectToDb();
    $this->connection = $connection->connectToDatabase();
  }

  public function setClassId($id){
    $this->id = $id;
    return $this;
  }

  public function getClassId(){
    return $this->id;
  }

  public function getClasses(){
    $sql = "SELECT `id`,`name` FROM class";
    try {
      $result = $this->connection->query($sql);
    }
    catch (\Exception $e) {
      return $e->getMessage();
    }
    return $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
  }

  public function getClassNameById(array $class_ids = NULL){
    $where  = !empty($class_ids) ? "WHERE `id` IN (". implode(',', $class_ids).")" : "WHERE `id` = $this->id";
    $sql = "SELECT `id`, `name` FROM class ". $where;
    try {
      $result = $this->connection->query($sql);
    }
    catch (\Exception $e) {
      return $e->getMessage();
    }
    return $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
  }

}