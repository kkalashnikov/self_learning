<?php
include($_SERVER['DOCUMENT_ROOT'] . '/src/Model/Classes.php');
include($_SERVER['DOCUMENT_ROOT'] . '/src/Model/School.php');

$classes = new Classes();
// Classes associative array
$class_list = $classes->getClasses();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>School Class Mapping</title>
</head>
<body>
  <?php
    include('header.php');
    if(isset($_POST['submit'])) {
      $school_name= $_POST['school_name'];
      $class_ids= $_POST['class_list'];
      $school = new School();
      $school_id = $school->registerSchool($school_name);
      foreach ($class_ids as $value) {
        $school_class_arr[] = "(".$school_id.",".$value.")";
      }
      $school->insertSchoolAndClass($school_class_arr);

    }
  ?>
  <div class="container" style="text-align: center;">
    <h3>School's classes</h3>
    <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="form-group row">
        <label for="school" class="col-sm-2 col-form-label">School</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="school" name="school_name" placeholder="school name">
          <?php echo $errName; ?>
        </div>
      </div>
      <div class="form-group row">
        <label for="class" class="col-sm-2 col-form-label">Classes</label>
        <div class="col-sm-10">
        <?php foreach ($class_list as $class) { ?>
          <label class="col-sm-1 container" style="float:left;">
            <input type="checkbox" name="class_list[]" value="<?php echo $class['id'] ?>"><?php echo ' '.$class['name'] ?>
          </label>
        <?php } ?>
          <?php echo $errName; ?>
        </div>
      </div>
      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
          <input type="submit" value="Submit" name="submit" class="btn btn-primary"/>
        </div>
      </div>
    </form>
  </div>
  <script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>

<!-- CREATE TABLE school (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL
);

CREATE TABLE school_class_mapping (
school_id INT(6) NOT NULL,
class_id INT(6)  NOT NULL,
PRIMARY KEY(school_id, class_id)
);

CREATE TABLE class (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(5) NOT NULL
);

insert into class (`name`)
values ('I'), ('II'),('III'), ('IV'), ('V'), ('VI'), ('VII'), ('VIII'), ('IX'), ('X'), ('XI'), ('XII'); -->