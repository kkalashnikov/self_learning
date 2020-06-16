<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/database/ConnectToDb.php');

/**
 * Provides school listing module.
 */
class School {


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

  public function setSchoolId($id){
    $this->id = $id;
    return $this;
  }

  public function getSchoolId(){
    return $this->id;
  }

  /**
   *
   */
  public function registerSchool($school){
    $query = "INSERT INTO school (`name`) VALUES('$school')";
    try {
      $this->connection->query($query);
      $school_id = $this->connection->insert_id;
      if ($this->connection->error_list) {
        return $this->connection->error_list[0]['error'];
      }
      return $school_id;
    }
    catch (\Exception $e) {
      return $e->getMessage();
    }
  }
  /**
   *
   */
  public function insertSchoolAndClass($school_cls_map){
    $values = implode(",", $school_cls_map);
    $sql = "INSERT INTO school_class_mapping (`school_id`,`class_id`) VALUES $values";
    try {
      $this->connection->query($sql);
      if ($this->connection->error_list) {
        return $this->connection->error_list[0]['error'];
      }
    }
    catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  /**
   *
   */
  public function listAllSchools(){
    $sql = "SELECT `id`,`name` FROM school";
    try {
      $result = $this->connection->query($sql);
    }
    catch (\Exception $e) {
      return $e->getMessage();
    }
    return $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
  }

  public function classesBySchoolId(){
    $sql = "SELECT `class_id` FROM school_class_mapping
              WHERE `school_id` = '.$this->id.'";
    try {
      $result = $this->connection->query($sql);
    }
    catch (\Exception $e) {
      return $e->getMessage();
    }
    return $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
  }
}