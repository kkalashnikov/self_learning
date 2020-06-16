<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/database/ConnectToDb.php');
include_once('UserInterface.php');

/**
 * Students class.
 */
class Student implements UserInterface {

  /**
   * Student id.
   *
   * @var int
   */
  protected $id;

  /**
   * Student name.
   *
   * @var string
   */
  private $name;

  /**
   * Student age.
   *
   * @var int
   */
  private $email;


  /**
   * Database object.
   *
   * @var object
   */
  protected $db;

  /**
   * Student constructor.
   */
  function __construct() {
    // Connecting to database.
    $connection = new ConnectToDb();
    $this->connection = $connection->connectToDatabase();
  }

  /**
   * Set Student id.
   *
   * @param int $id
   *   Student id.
   *
   * @return object
   *   Class reference.
   */
  public function setStudentId($id) {
    $this->id = $id;

    return $this;
  }

  /**
   * Fetch Student id.
   *
   * @return int
   *   Student id.
   */
  public function getStudentId() {
    return $this->id;
  }

  /**
   * @return string
   */
  public function name() {
    $query = "SELECT `name` FROM student WHERE id = $this->id";
    try {
      $result = $this->db->query($query);
    }
    catch (\Exception $e) {
      return $e->getMessage();
    }
    if ($result->num_rows > 0) {
      return TRUE;
    }
    $this->name = $result->num_rows > 0 ? $result->fetch_fields() : '';
    return $this->name;
  }

  /**
   * @return string
   */
  public function email() {
    $query = "SELECT `email` FROM student WHERE id = $this->id";
    try {
      $result = $this->db->query($query);
    }
    catch (\Exception $e) {
      return $e->getMessage();
    }
    if ($result->num_rows > 0) {
      return TRUE;
    }
    $this->email = $result->num_rows > 0 ? $result->fetch_fields() : '';
    return $this->email;
  }

  /**
   * Fetch Student information.
   *
   * return array
   *   Student array.
   */
  public function fetchStudentInfo() {
    $query = "SELECT st.id, st.gender, st.age, st.name, st.email, st.mobile, st.address,
    sc.name AS school_name,
    cl.name as class_name, cl.subjects, cl.section
    from students AS st
    LEFT JOIN schools AS sc ON st.school_id = sc.id
    LEFT JOIN classes AS cl ON st.class_id = cl.id
    WHERE st.id = {$this->id}";
    try {
      $result = $this->db->query($query);
    }
    catch (\Exception $e) {
      return $e->getMessage();
    }
    if (empty($result->num_rows)) {
      return FALSE;
    }

    return $result->fetch_assoc();
  }

  /**
   * Update Student information.
   *
   * return bool
   *   True|False
   */
  public function insertStudentInfo($info) {
    $columns = implode(", ", array_keys($info));
    $values  = implode(", ", array_map(function($val) { return '"'.$val.'"';} , array_values($info)));
    $sql = "INSERT INTO student ($columns) VALUES ($values)";
    try {
      $this->connection->query($sql);
      if ($this->connection->error_list) {
        return $this->connection->error_list[0]['error'];
      }
    }
    catch (\Exception $e) {
      return $e->getMessage();
    }

    return FALSE;
  }

  /**
   * @param $school_id
   *
   * @return array|string|void
   */
  public function listStudentsBySchool($school_id) {
    $output = [];
    $query = "SELECT st.id, st.name, st.email, st.mobile, st.address, st.age, st.gender,
    sc.name AS school_name,
    cl.name as class_name, cl.subjects, cl.section
    from students AS st
    LEFT JOIN schools AS sc ON st.school_id = sc.id
    LEFT JOIN classes AS cl ON st.class_id = cl.id
    WHERE sc.id = {$school_id}";
    try {
      $result = $this->db->query($query);
    }
    catch (\Exception $e) {
      return $e->getMessage();
    }
    if ($result->num_rows > 0) {
      while ($rows = $result->fetch_assoc()) {
        $output[] = $rows;
      }
    }

    return $output;
  }

}