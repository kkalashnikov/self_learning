<?php
//include($_SERVER['DOCUMENT_ROOT'] . '/src/Model/School.php');
include($_SERVER['DOCUMENT_ROOT'] . '/src/Model/Classes.php');

$school = new School();
// Class associative array
$school_list = $school->listAllSchools();

$classes = new Classes();
// $classes = $school->classesBySchoolId(array_column($school_list,'id'));
// print_r($classes); die;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Schools</title>
</head>

<body>
    <?php
    include('header.php');
    if(isset($_POST['submit'])) {
      $school_name= $_POST['school_name'];
      $class_list= $_POST['class_list'];
      $school = new School();
      $school_id = $school->registerSchool($school_name);
      foreach ($class_list as $value) {
        $school_class_arr[] = "(".$school_id.",".$value.")";
      }
      //$school->updateSchoolAndClass($school_class_arr);

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
                    $school->setSchoolId($value['id']);
                    $class_list = $school->classesBySchoolId();
                    $classes_info = $classes->getClassNameById(array_column($class_list, 'class_id'));
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