<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/autoload.php';
use Model\Classes;

$classes = new Classes();
// Get classes by school id.
$class_ids = $classes->classesBySchoolId($_POST['schoolId']);
$class_ids = array_column($class_ids, 'class_id');
// Fetch name of the classes through id.
$cls_names = $classes->getClassNameById($class_ids);
foreach($cls_names as $value){
    echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
}
?>