<?php
 session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
    crossorigin="anonymous">
  <title>Teacher Login</title>
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
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item px-5">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item px-5">
                        <a class="nav-link" href="../routes/admin_login.php">Admin</a>
                    </li>
                    <li class="nav-item px-5">
                        <a class="nav-link" href="../routes/student_login.php">Student</a>
                    </li>
                    <li class="nav-item active px-5">
                        <a class="nav-link" href="../routes/teacher_login.php">Teacher</a>
                    </li>
                    </ul>
                </div>
                </nav>
        </div>
        </div>
        <br>
        <div class="row py-4 ">
            <div class="col-md-2"></div>
            <div class="col-md-8 text-center">
                <h3 id="groups">Teacher Login</h3><br>
                <div id="loginSection" class="text-center p-5 align-items-center">
                    <form>
                        <div class="form-row py-1 ">
                            <div class="form-group col-md-12 px-4">
                            <input type="text" id="id" class="form-control" placeholder="Teacher ID">
                            </div>
                        </div>
                        <div class="form-row py-1">
                            <div class="form-group col-md-12 px-4">
                            <input id="pass" type="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
              
                        <div class="form-row py-1">
                            <div class="col-md-3"></div>
                            <div class="form-group col-md-6">
                            <input type="button" onclick="loginFun()" id="loginbtn" class="form-control btn btn-success" value="Login">
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>

<script src="../resources/js/teacher-login.js"></script>

</body>

</html>