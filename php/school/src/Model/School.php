<?php

namespace Model;

use Database\ConnectToDb;

/**
 * Class School.
 */
class School {

  /**
   * School id.
   *
   * @var int
   */
  private $id;

  /**
   * Database object.
   *
   * @var object
   */
  private $connection;

  /**
   * School constructor.
   */
  function __construct() {


    // Connecting to database.
    $connection = new ConnectToDb();
    $this->connection = $connection->connectToDatabase();

  }

  /**
   * Set school id.
   *
   * @var int $id
   *
   * @return object
   *   Class reference
   */
  public function setSchoolId($id){
    $this->id = $id;
    return $this;
  }

  /**
   * Get school id.
   *
   * @return int
   *   School id.
   */
  public function getSchoolId(){
    return $this->id;
  }

  /**
   * Register school into db.
   *
   * @var string $school
   *   School name.
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
   * Mapping school and classes.
   *
   * @var array $school_cls_map
   *   School classes array.
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
   * List schools
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

}