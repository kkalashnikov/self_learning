<?php

use Model\School;
use Model\Classes;

$school = new School();
// Class associative array
$school_list = $school->listAllSchools();

$classes = new Classes();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Schools</title>
</head>

<body>
    <?php
    if(isset($_POST['submit'])) {
      $school_name= $_POST['school_name'];
      $class_list= $_POST['class_list'];
      $school_id = $school->registerSchool($school_name);
      foreach ($class_list as $value) {
        $school_class_arr[] = "(".$school_id.",".$value.")";
      }

    }
  ?>
    <div class="container">
        <h3>Schools</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>School</th>
                    <th>Classes</th>
                </tr>
            </thead>
            <tbody>
                  <?php
                  foreach($school_list as $value){
                    // Classes by school id.
                    $class_list = $classes->classesBySchoolId($value['id']);
                    $classes_info = $classes->getClassNameById(array_column($class_list, 'class_id'));
                    // Fetch class name by class id.
                    $classes_name = array_column($classes_info, 'name');

                    echo '<tr>';
                    echo '<td>'.$value['id'].'</td>';
                    echo '<td>'.$value['name'].'</td>';
                    echo '<td>'.implode(', ' , $classes_name).'</td>';
                    echo '</tr>';
                  }
                  ?>

            </tbody>
        </table>
    </div>

</body>

</html>