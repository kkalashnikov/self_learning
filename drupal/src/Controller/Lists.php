<?php

namespace Drupal\listing\Controller;

use Drupal\listing\School;
use Drupal\listing\Classes;

/**
 * Provides listing.
 */
class Lists {

  /**
   * Return arguments in url.
   */
  public function getArgument() {
    return $_GET['type'];
  }

  /**
   * Returns a simple page with listings.
   *
   * @return array
   *   A simple rendered array.
   */
  public function listing() {

    // Get argument from url.
    $type = $this->getArgument();

    switch ($type) {
      case "schools":
        $schools = new School();
        $list = $schools->getSchools();
        break;

      case "class-in-schools":
        $classes = new Classes();
        $list = $classes->classesInSchool();
        break;

      case "teachers-of-schools":
        $teachers = new Teachers();
        // Set school tid.
        $teachers->setSchoolTid($tid);
        $list = $teachers->getTeachersInSchool();
        break;

      case "students-in-a-class-of-one-school":
        // Use $school_tid and $class_tid.
        $students = new Students();
        // Set school tid.
        $students->setSchoolTid($school_tid);
        // Set class tid.
        $students->setClassTid($class_tid);
        $list = $students->getStudentsInAClassOfSchool();
        break;

      case "All-hods-of-physics":
        // Get all physics hods of all schools
        // use $subject_id and $designation.
        $teachers = new Teachers();
        $teachers->subjectId = $subject_id;
        $teachers->designationId = $designation;
        $list = $teachers->getSubjectTeachersWithDesignation();
        break;

      default:
        break;
    }
    return [
      '#markup' => 'pass "type=schools" as an argument to get schools listing</br>
                    pass "type=class-in-schools" as an argument to get classes in schools listing</br>'
      . $list,
    ];
  }

}
