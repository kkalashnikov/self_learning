<?php
include($_SERVER['DOCUMENT_ROOT']. '/src/Model/School.php');
include($_SERVER['DOCUMENT_ROOT'] . '/src/Model/Student.php');
$school = new School();
$school_list_arr = $school->listAllSchools();
$school_list = array_column($school_list_arr, 'name','id');


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>School Admission Form</title>
<script>
  function fetch_select(school_id){
    $('.class-list').hide();
    if(school_id != 'select'){
      $('.class-list').show();
    }
    $.ajax({
      type: 'post',
      url: '../fetch_classes.php',
      data: {
        schoolId:school_id
      },
      success: function (response) {
        document.getElementById("admitClass").innerHTML=response;
      }
    });
  }
</script>
</head>
<body>
  <?php
    include('header.php');
    if(isset($_POST['submit'])) {
      $student = new Student();
      unset($_POST['submit']);
      $student->insertStudentInfo($_POST);
      print_r($_POST); die;

        $email= $_POST['email'];
        $name= $_POST['user'];
        $password = $_POST['password'];
      // Check if name has been entered
      if(empty($_POST['email'])) {
        $errEmail= 'Please enter a valid email address';
      }
      // Check if email has been entered and is valid
      else if(empty($_POST['name'])) {
        $errName = 'Please enter your name';
      }
    }
  ?>
  <div class="container" style="text-align: center;">
    <h3>School Admission Form</h3>
    <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="form-group row">
        <label for="admitEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="admitEmail" name="email" placeholder="Email">
          <?php echo $errEmail; ?>
        </div>
      </div>
      <div class="form-group row">
        <label for="admitUser" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="admitUser" name="name" placeholder="Name">
          <?php echo $errName; ?>
        </div>
      </div>
      <div class="form-group row">
        <label for="admitSchool" class="col-sm-2 col-form-label">School</label>
        <div class="col-sm-10">
        <select class="col-sm-12" id="admitSchool" name="school_id" onchange="fetch_select(this.value);">
          <?php
          echo '<option value="select">Select</option>';
          foreach ($school_list as $key => $value) {
            echo '<option value="'.$key.'">'.$value.'</option>';
          } ?>
        </select>
          <?php echo $errName; ?>
        </div>
      </div>
      <div class="form-group row class-list" style="display: none;">
        <label for="admitClass" class="col-sm-2 col-form-label">Class</label>
        <div class="col-sm-10">
        <select class="col-sm-12" id="admitClass" name="class_id">
        </select>
          <?php echo $errName; ?>
        </div>
      </div>
      <!-- <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
          <?php //echo $errPass; ?>
        </div>
      </div> -->
      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
          <input type="submit" value="Register" name="submit" class="btn btn-primary"/>
        </div>
      </div>
    </form>
  </div>
  <script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>