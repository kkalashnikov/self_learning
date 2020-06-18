<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/database/ConnectToDb.php');

/**
 * Class classes.
 */
class Classes {


  /**
   * Class id.
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
   * Classes constructor.
   */
  function __construct() {
    // Connecting to database.
    $connection = new ConnectToDb();
    $this->connection = $connection->connectToDatabase();
  }

  /**
   * Set class id.
   *
   *  * @param int $id
   *   Class id.
   *
   * @return object
   *   Class reference.
   */
  public function setClassId($id){
    $this->id = $id;
    return $this;
  }

  /**
   * Get class id.
   *
   * @return int
   *   Class id.
   */
  public function getClassId(){
    return $this->id;
  }

  /**
   * Get all classes.
   */
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

  /**
   * Get class name by class id.
   *
   * @var array $class_ids
   *
   */
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

  /**
   * Get classes by school id.
   *
   * @var int $schoolId
   */
  public function classesBySchoolId($schoolId){
    $sql = "SELECT `class_id` FROM school_class_mapping
              WHERE `school_id` = '.$schoolId.'";
    try {
      $result = $this->connection->query($sql);
    }
    catch (\Exception $e) {
      return $e->getMessage();
    }
    return $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
  }

}