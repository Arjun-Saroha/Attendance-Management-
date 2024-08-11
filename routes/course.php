<?php
session_start();
  if(!isset($_SESSION['admin'])){
    header("location:../");
  }
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->

  <title>Admin Dashboard - Course</title>
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
        <div class="row pt-3 pb-2">
        <div class="col-md-12">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand h1" href="#">Admin</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item px-3">
                        <a class="nav-link" href="../routes/admin_dashboard.php">Student</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link" href="../routes/admin_teacher.php">Teacher</a>
                    </li>
                    <li class="nav-item active px-3">
                        <a class="nav-link" href="../routes/course.php">Course</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link" href="../routes/subject.php">Subject</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link" href="../routes/admin_attendance.php">Attendance</a>
                    </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item px-3">
                        <a class="nav-link" href="../routes/logout.php">Logout <i class="fa fa-user-circle"></i></a>
                    </li>
                    </ul>
                </div>
                </nav>
        </div>
        </div>
        <hr>
        <div class="row py-1">
            <div class="col-md-12 text-center">
                <form>
                    <div class="form-row">
                        <div class="form-group text-center col-md-12">
                        <h4>Add new course</h4>
                        </div>
                    </div>
                </form>
                <form>
                    <div class="form-row pt-3">
                        <div class="form-group col-md-4">
                            <input class="form-control" type="text" placeholder="Name" id="name">
                        </div>
                        <div class="form-group col-md-6">
                            <input class="form-control" type="text" placeholder="Duration" id="duration">
                        </div>
                        <div class="form-group col-md-2">
                            <button class="btn btn-success form-control" style="background-color:green" type="button" onclick="addCourse()">Add +</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="py-3" id="courseList"></div>
            </div>
        </div>
    </div>
</div>

<script src="../resources/js/course.js"></script>

</body>

</html>