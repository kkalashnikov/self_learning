<?php

namespace Drupal\listing\Controller;

/**
 * Provides school listing module.
 */
class School {

  protected $vid = 'school';
  protected $schoolTid;

  /**
   * Set school tid.
   */
  public function setSchoolTid($tid) {
    $this->schoolTid = $tid;
  }

  /**
   * Get school tid.
   */
  public function getSchoolTid() {
    return $this->schoolTid;
  }

  /**
   * Returns all schools.
   *
   * @return array
   *   School list.
   */
  public function getSchools() {
    $connection = \Drupal::database();
    $query = $connection->select('taxonomy_term_field_data', 't');
    $query->condition('t.vid', $this->vid, '=');
    $query->fields('t', ['name', 'tid']);
    return $query->execute()->fetchAll();
  }

  /**
   * Returns school name by tid.
   *
   * @return string
   *   School name.
   */
  public function getSchoolsNameByTid() {
    // Get school name using $this->getSchoolTid().
    return $name;
  }

}
