<?php

use Database\ConnectToDb;

/**
 * Teachers class.
 */
class Teachers extends School {

  /**
   * Return teachers of a school.
   */
  public function getTeachersInSchool() {
    // Get all teachers uid using $school_tid by db_query
    $all_teachers_uid = $this->getAllTeachersUid();
    $this->teachersUidArray = $all_teachers_uid;
    $teachers_name = $this->getTeachersNamesFromUidArray();
    return $teachers_name;
  }

  /**
   * Will return all teachers uid
   *
   * @return array
   * Users uid
   */
  public function getAllTeachersUid() {
      $uid = db_query("Get teachers uid using $this->getSchoolTid()");
      return $uid;
  }

  /**
   * Return specific subject teachers for particular designation.
   */
  public function getSubjectTeachersWithDesignation() {
    $teachers_uids = db_query("Write query to get teachers uid using $this->subjectId and $this->designationId");
    $this->teachersUidArray = $teachers_uids;
    $teachers_name = $this->getTeachersNamesFromUidArray();
    return $teachers_name;
  }

  /**
   * Get teachers name array from uid array
   */
  public function getTeachersNamesFromUidArray() {
    foreach ($this->teachersUidArray as $value) {
      $this->setTeacherUid($value['uid']);
      $teachers_name[] = $this->getTeacherNameByUid();
    }
    return $teachers_name;
  }
}