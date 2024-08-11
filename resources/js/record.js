getRecord();

function getRecord() {
  $.ajax({
    url: "../api/api.php",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify({
      call: 19,
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
  
            studentList += '<form method="POST" action="../api/teacher_attach.php"><div class="form-row"><div class="col-md-7 form-group"><h4 class="pb-2">Date: '+d.date+'</h4></div><div class="col-md-5 form-group"><input name="date" type="hidden" value="'+d.date+'"><button type="submit" name="getFile" class="btn btn-success">Download <i class="fa fa-book"></i></button></div></div></form><div class="table-responsive-md" style="background-color:white">' +
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
            '</table></div><br><form method="POST" action="../api/teacher_attach.php"><div class="form-row"><div class="col-md-7 form-group"><h4 class="pb-2">Date: '+d.date+'</h4></div><div class="col-md-5 form-group"><input name="date" type="hidden" value="'+d.date+'"><button type="submit" name="getFile" class="btn btn-success">Download <i class="fa fa-book"></i></button></div></div></form><div class="table-responsive-md" style="background-color:white">' +
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
