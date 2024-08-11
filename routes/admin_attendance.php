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

  <title>Admin Dashboard - Attendance</title>
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
                    <li class="nav-item px-3">
                        <a class="nav-link" href="../routes/course.php">Course</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link" href="../routes/subject.php">Subject</a>
                    </li>
                    <li class="nav-item active px-3">
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
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="py-3" id="studentList"></div>
            </div>
        </div>
    </div>
</div>

<script>
getRecord();

function getRecord() {
  $.ajax({
    url: "../api/api.php",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify({
      call: 13,
    }),
    success: function (data) {
      var studentsData = data;
      var sr = 1;
      var students = "";
      var record = '';
      var sid = '';
      var studentList = '';
      var status = '';

      if(studentsData==0){
        $("#studentList").html('<p>No records available.</p>');
      }
      else{
        $.each(studentsData, function (i, d) {

          status = (d.record==1) ? '<span class="badge badge-success badge-pill px-3 py-2">Present</span>' : '<span class="badge badge-danger badge-pill px-3 py-2"><b>Absent</b></span>';
  
          if(record==''){
            students =
            "<tr>" +
            '<th scope="row">' +
            sr +
            "</th>" +
            '<td colspan="2">' +
            d.name +
            "</td>" +
            '<td scope="col">' +
            d.roll_no +
            "</td>" +
            '<td scope="col">' +
            d.course +
            "</td>" +
            '<td scope="col">' +
            d.subject +
            "</td>" +
            '<td scope="col">' +
            d.date +
            "</td>" +
            '<td scope="col">' +
            status +
            "</td>" +
            "</tr>";
  
            studentList += '<form method="POST" action="../api/admin_attach.php"><div class="form-row"><div class="col-md-7 form-group"><h4 class="pb-2">Date: '+d.date+'</h4></div><div class="col-md-5 form-group"><input name="date" type="hidden" value="'+d.date+'"><button type="submit" name="getFile" class="btn btn-success">Download <i class="fa fa-book"></i></button></div></div></form><div class="table-responsive-md" style="background-color:white">' +
            '<table class="table table-bordered">' +
            "<thead>" +
            "<tr>" +
            '<th scope="col">Sr.no.</th>' +
            '<th colspan="2">Name</th>' +
            '<th scope="col">Roll No</th>' +
            '<th scope="col">Course</th>' +
            '<th scope="col">Subject</th>' +
            '<th scope="col">Date</th>' +
            '<th scope="col">Status</th>' +
            "</tr>" +
            "</thead>" +
            "<tbody>" +
            students;
            record = d.date;
            sr++;
            console.log(studentList);
          }
          else if(record==d.date){
  
            students =
            "<tr>" +
            '<th scope="row">' +
            sr +
            "</th>" +
            '<td colspan="2">' +
            d.name +
            "</td>" +
            '<td scope="col">' +
            d.roll_no +
            "</td>" +
            '<td scope="col">' +
            d.course +
            "</td>" +
            '<td scope="col">' +
            d.subject +
            "</td>" +
            '<td scope="col">' +
            d.date +
            "</td>" +
            '<td scope="col">' +
            status +
            "</td>" +
            "</tr>";
            studentList+=students;
            record = d.date;
            sr++;
            console.log(studentList);
  
          }
          else if(record!=d.date){
            sr = 1;
            students =
            "<tr>" +
            '<th scope="row">' +
            sr +
            "</th>" +
            '<td colspan="2">' +
            d.name +
            "</td>" +
            '<td scope="col">' +
            d.roll_no +
            "</td>" +
            '<td scope="col">' +
            d.course +
            "</td>" +
            '<td scope="col">' +
            d.subject +
            "</td>" +
            '<td scope="col">' +
            d.date +
            "</td>" +
            '<td scope="col">' +
            status +
            "</td>" +
            "</tr>";
  
            studentList+="</tbody>"+
            '</table></div><br><form method="POST" action="../api/admin_attach.php"><div class="form-row"><div class="col-md-7 form-group"><h4 class="pb-2">Date: '+d.date+'</h4></div><div class="col-md-5 form-group"><input name="date" type="hidden" value="'+d.date+'"><button type="submit" name="getFile" class="btn btn-success">Download <i class="fa fa-book"></i></button></div></div></form><div class="table-responsive-md" style="background-color:white">' +
            '<table class="table table-bordered">' +
            "<thead>" +
            "<tr>" +
            '<th scope="col">Sr.no.</th>' +
            '<th colspan="2">Name</th>' +
            '<th scope="col">Roll No</th>' +
            '<th scope="col">Course</th>' +
            '<th scope="col">Subject</th>' +
            '<th scope="col">Date</th>' +
            '<th scope="col">Status</th>' +
            "</tr>" +
            "</thead>" +
            "<tbody>" +
            students;
            record = d.date;
            sr++;
          }
        });

        $("#studentList").html(studentList);
      }

    },
  });
}

</script>

</body>

</html>