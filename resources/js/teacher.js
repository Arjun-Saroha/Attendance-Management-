  populateCourses();
  populateSubjects();
  getTeachers();

function populateCourses() {
    $.ajax({
      url: "../api/api.php",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      data: JSON.stringify({
        call: 2,
      }),
      success: function (data) {
        var courses = data;
        var course = '';
        var sr = 1;

        if(courses == 0){
            $("#rcourse").html('<option>No course available at present</option>');
        }
        else{
            $.each(courses, function (i, d) {
            course += 
                '<option value="'+d.name+' - '+d.duration+'">'+d.name+' - '+d.duration+'</option>';
        });
  
        $("#rcourse").html('<option value="">Select Course</option>'+course);
        }
        
      },
    });
}

function populateSubjects() {
  var course = $("#rcourse").val();
  $.ajax({
    url: "../api/api.php",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify({
      call: 3,
      course: course
    }),
    success: function (data) {
      var subjects = data;
      var subject = '';
      var sr = 1;

      if(subjects == 0){
          $("#rsub").html('<option>No subject available at present</option>');
      }
      else{
          $.each(subjects, function (i, d) {
              subject += 
              '<option value="'+d.name+'">'+d.name+'</option>';
      });

      $("#rsub").html(subject);
      }
      
    },
  });
}

$( "#rcourse" ).change(function() {
  var name = $("#rcourse").val();
  $.ajax({
    url: "../api/api.php",
    type: "POST",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify({
      call: 4,
      name: name
    }),
    success: function (data) {
      var subjects = data;
      var subject = '';
      var sr = 1;

      if(subjects == 0){
          $("#rsub").html('<option>No subject available at present</option>');
      }
      else{
          $.each(subjects, function (i, d) {
              subject += 
              '<option value="'+d.name+'">'+d.name+'</option>';
      });

      $("#rsub").html(subject);
      }
      
    },
  });
});

function getTeachers() {
        $.ajax({
        url: "../api/api.php",
        type: "POST",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify({
            call: 7,
        }),
        success: function (data) {
            console.log(data);
            var studentsData = data;
            var students = '';
            var sr = 1;
            $.each(studentsData, function (i, d) {
                students +=
                    "<tr>" +
                    '<th scope="row">' +
                    sr +
                    "</th>" +
                    '<td colspan="2">' +
                    d.name +
                    "</td>" +
                    '<td scope="col">' +
                    d.designation +
                    "</td>" +
                    '<td scope="col">' +
                    d.course +
                    "</td>" +
                    '<td scope="col">' +
                    d.subject +
                    "</td>" +
                    "</tr>";
                sr++;
            });
    
            $("#teacherList").html(
            '<div class="table-responsive-md" style="background-color:white">' +
                '<table class="table table-bordered">' +
                "<thead>" +
                "<tr>" +
                '<th scope="col">Sr.no.</th>' +
                '<th colspan="2">Name</th>' +
                '<th scope="col">Designation</th>' +
                '<th scope="col">Course</th>' +
                '<th scope="col">Subject</th>' +
                "</tr>" +
                "</thead>" +
                "<tbody>" +
                students +
                "</tbody>" +
                "</table></div>"
            );
        },
        });
}

function addTeacher() {
  var name = $("#rname").val();
  var sub = $("#rsub").val();
  var des = $("#rdes").val();
  var course = $("#rcourse").val();

  if (
    name == "" ||
    des == "" ||
    sub == "" ||
    course == "" 
    ) {
    alert("Fields should be blank!");
  } else {
    $.ajax({
      url: "../api/api.php",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      data: JSON.stringify({
        call: 8,
        name: name,
        des: des,
        sub: sub,
        course: course
      }),
      success: function (data) {
        var id = data[1];
        var pass = data[2];
        if (data[0] == 1) {
          getTeachers();
          swal({
            title: "Thank you, "+name,
            text: "You are added on E-Attendance!\nId: "+id+"\nPassword: "+pass,
            icon: "success",
            button: "OK!",
          });

          $("#rname").val("");
          $("#rdes").val("");
        } 
        else if(data==2){
          swal({
            title: "Teacher already exists!",
            text: "There's already a teacher who has same course and subject",
            icon: "warning",
            button: "OK!",
          });
        }
        else {
          swal({
            title: "Error!",
            text: "Some error occured!",
            icon: "error",
            button: "OK!",
          });
        }
      },
    });
  }
}


  function loginFun(){
    var id = $("#id").val();
    var pass = $("#pass").val();

    if(id=='' || pass==''){
      alert("Fields cannot be blank!");
    }
    else{
      $.ajax({
        url : '../api/api.php',
        type : 'POST',
        dataType : 'json',
        contentType : 'application/json',
        data : JSON.stringify({
            call : 2,
            id : id,
            pass : pass,
        }),
        success : function(data){
            if(data==0){
                swal({
                        title: "Invalid Credentials!",
                        text: "Id or Password is invalid!",
                        icon: "error",
                        button: "OK!",
                });
            }
            else{
               window.location = 'teacher_dashboard.php';
            }
        }
        
      });
    }
  }
  
  
  function searchStudent() {
    var course = $("#course1").val();
    var semester = $("#semester1").val();
    var branch = $("#branch1").val();
  
    if (course == "" || semester == "" || branch == "") {
      alert("Fields should be blank!");
    } else {
      $.ajax({
        url: "../api/api.php",
        type: "POST",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify({
          call: 6,
          course: course,
          semester: semester,
          branch: branch,
        }),
        success: function (data) {
          if (data.length > 0) {
            var sr = 1;
            var students = "";
  
            $.each(data, function (i, d) {
              students +=
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
                d.semester +
                "</td>" +
                '<td scope="col">' +
                d.branch +
                "</td>" +
                "</tr>";
              sr++;
            });
  
            $("#studentList").html(
              '<div class="table-responsive-md" style="background-color:white">' +
                '<table class="table table-bordered">' +
                "<thead>" +
                "<tr>" +
                '<th scope="col">Sr.no.</th>' +
                '<th colspan="2">Name</th>' +
                '<th scope="col">Roll No</th>' +
                '<th scope="col">Course</th>' +
                '<th scope="col">Semester</th>' +
                '<th scope="col">Branch</th>' +
                "</tr>" +
                "</thead>" +
                "<tbody>" +
                students +
                "</tbody>" +
                "</table></div>"
            );
          } else {
            $("#studentList").html("<p><b>No matching records found!</b>");
          }
        },
      });
    }
  }
  
  
  function conFirm(id, record){
    var sid = id;
    var record = record;
    swal({
        title: 'Are you sure?',
        text: "Confirm once before marking attendance!",
        icon: "warning",
        buttons: ['Cancel', 'Confirm'],
        dangerMode: true,
        })
        .then((ok) => {
        if (ok) {
            addAttendance(sid, record);
        } else {
            swal("Think again!");
        }
    });
  }
  
  function addAttendance(sid, record) {
    var sid = sid;
    var record = record;
      
    $.ajax({
        url: "../api/api.php",
        type: "POST",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify({
          call: 8,
          sid :sid,
          record : record
        }),
        success: function (data) {
          if (data == 1) {
            getStudents();
          } else {
            swal({
              title: "Error!",
              text: "Some error occured!",
              icon: "error",
              button: "OK!",
            });
          }
        },
      });
  }