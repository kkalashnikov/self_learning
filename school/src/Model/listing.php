<?php

include('School.php');
include('Classes.php');

/**
 * Provides listings.
 */
class Lists {

    /**
     * Returns a simple page with listings.
     *
     * @return array
     *   A simple renderable array.
     *
     */

    public function listing() {
        //print_r($_GET); die;
        if(count($_GET) >= 1 && isset($_GET['school'])){
            $classes = new Classes();
            //print_r($classes->classesInSchool($_GET['school'])); die;
            return $classes->classesInSchool($_GET['school']);
        }else{
            $schools = new School();
            foreach($schools->getSchools() as $school){
               $school_listing .= '<li><a href="/listing.php?school='.$school.'">'.ucfirst($school).'</a></li>';
            }
            return $school_listing;
        }

        switch ($arg) {
            case "school":
                $classes = new Classes();
                $list = $classes->classesInSchool();
                break;
            case "classes":
                $classes = new Classes();
                $list = $classes->classesInSchool();
                break;
            case "teachers":
                $teachers = new Teachers();
                // Set school tid
                $teachers->setSchoolTid($tid);
                $list = $teachers->getTeachersInSchool();
                break;
            case "students-in-a-class-of-one-school":
                // use $school_tid and $class_tid
                $students = new Students();
                // Set school tid
                $students->setSchoolTid($school_tid);
                // Set class tid
                $students->setClassTid($class_tid);
                $list = $students->getStudentsInAClassOfSchool();
                break;
            case "All-hods-of-physics":
                // get all physics hods of all schools
                // use $subject_id and $designation
                $teachers = new Teachers();
                $teachers->subjectId = $subject_id;
                $teachers->designationId = $designation;
                $subjectHods = $teachers->getSubjectTeachersWithDesignation();
                break;
            default:
                $schools = new School();
                foreach($schools->getSchools() as $school){
                $element .= '<li><a href="/listing.php?school='.$school.'">'.ucfirst($school).'</a></li>';
                }
        }
    return $element;
    }
}

$listing = new Lists();
echo $listing->listing();

?>