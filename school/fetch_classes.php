<?php
include('src/Model/Classes.php');

$school = new School();
$school->setSchoolId($_POST['schoolId']);
$class_ids = $school->classesBySchoolId();
$class_ids = array_column($class_ids, 'class_id');
$classes = new Classes();
$cls_names = $classes->getClassNameById($class_ids);
foreach($cls_names as $value){
    echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
}
?>