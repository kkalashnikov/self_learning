<?php

namespace Drupal\listing;

/**
 * Provides listing.
 */
class Students extends Classes {

  protected $studentUid;

  /**
   * Set student Uid.
   */
  public function setStudentUid($uid) {
    $this->studentUid = $uid;
  }

  /**
   * Get student Uid.
   */
  public function getStudentUid() {
    return $this->studentUid;
  }

  /**
   * Return student name by uid.
   */
  public function getStudentNameByUid() {
    return db_query("Get student name using $this->getStudentUid()");
  }

  /**
   * Return students of a class of a school.
   */
  public function getStudentsInAClassOfSchool() {
    $students_uid = db_query("Write a query using $this->getSchoolTid and $this->getClassTid");
    foreach ($students_uid as $value) {
      $this->setStudentUid($value['uid']);
      $student_names[] = $this->getStudentNameByUid();
    }
    return $student_names;
  }

}
