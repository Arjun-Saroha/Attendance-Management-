<?php
    session_start();
    if(!isset($_SESSION['student'])){
        header('location:../');
    }
?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->

  <title>Student Dashboard - Attendance Management System</title>
  <link rel="stylesheet" href="../resources/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/css/stylesheet.css">
    <script src="../resources/Jquery/jquery-3.5.1.js"></script>
    <script src="../resources/Bootstrap/js/bootstrap.min.js"></script>
    <script src="../resources/js/sweetalert.min.js"></script>
    </head>

<body>

<div id="headerSection" class="sticky-top">
    <div class="container" >
        <div class="row">
            <div class="col-sm-12 text-center pt-3">
                <p id="brand">Attendance Management System</p>
            </div>
        </div>
    </div>
</div>

<div id="bodySection">
    <div class="container">
        <div class="row align-items-center py-3">
            <div class="col-md-1 text-center">
                <a href="teacher_dashboard.php"><button class="btn btn-sm btn-warning">Back</button></a>
            </div>
            <div class="col-md-9 text-center">
                <h3><?php echo $_SESSION['studentname']?></h3>
            </div>
            <div class="col-md-2 text-center">
                <a href="logout.php"><button class="btn btn-sm btn-primary">Logout <i class="fa fa-user-circle"></i></button></a>
            </div>
        </div>
        <hr>
        <div class="row pb-2">
            <div class="col-md-4">
                <b>Name : </b> <?php echo $_SESSION['studentname'] ?><br>
            </div>
            <div class="col-md-3">
                <b>Roll No : </b> <?php echo $_SESSION['roll'] ?><br>
            </div>
            <div class="col-md-5">
                <b>Course : </b> <?php echo $_SESSION['course'] ?><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <b>Subject : </b> <?php echo $_SESSION['subject'] ?><br>
            </div>
            <div class="col-md-8">
                <b>Address : </b> <?php echo $_SESSION['address'] ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="py-3" id="studentList"></div>
            </div>
        </div>    
    </div>
</div>

<script src="../resources/js/student-dashboard.js"></script>

</body>

</html>