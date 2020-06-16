<?php

namespace Drupal\listing;

/**
 * Teachers class.
 */
class Teachers extends School {

  protected $teacherUid;
  protected $subjectId;
  protected $designationId;
  protected $all_teachers_uid;

  /**
   * Will set teachers uid.
   */
  public function setTeacherUid($uid) {
    $this->teacherUid = $uid;
  }

  /**
   * Return teachers uid.
   */
  public function getTeacherUid() {
    return $this->teacherUid;
  }

  /**
   * Get teachers name by uid.
   */
  public function getTeacherNameByUid() {
    return db_query("get teacher name using $this->getTeacherUid()");
  }

  /**
   * Return teachers of a school.
   */
  public function getTeachersInSchool() {
    // Get all teachers uid using $school_tid by db_query.
    $this->teachersUidArray = $this->getAllTeachersUid();
    return $this->getTeachersNamesFromUidArray();
  }

  /**
   * Will return all teachers uid.
   *
   * @return array
   *   Users uid
   */
  public function getAllTeachersUid() {
    return db_query("Get teachers uid using $this->getSchoolTid()");
  }

  /**
   * Return specific subject teachers for particular designation.
   */
  public function getSubjectTeachersWithDesignation() {
    $this->teachersUidArray = db_query("Write query to get teachers uid using $this->subjectId and $this->designationId");;
    return $this->getTeachersNamesFromUidArray();
  }

  /**
   * Get teachers name array from uid array.
   */
  public function getTeachersNamesFromUidArray() {
    foreach ($this->teachersUidArray as $value) {
      $this->setTeacherUid($value['uid']);
      $teachers_name[] = $this->getTeacherNameByUid();
    }
    return $teachers_name;
  }

}
