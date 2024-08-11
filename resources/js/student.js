populateCourses();
populateSubjects();
getStudents();

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

function getStudents() {
  $.ajax({
  url: "../api/api.php",
  type: "POST",
  dataType: "json",
  contentType: "application/json",
  data: JSON.stringify({
      call: 5,
  }),
  success: function (data) {
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
              d.course +
              "</td>" +
              '<td scope="col">' +
              d.subject +
              "</td>" +
              '<td scope="col">' +
              d.roll_no +
              "</td>" +
              '<td scope="col">' +
              d.address +
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
          '<th scope="col">Course</th>' +
          '<th scope="col">Subject</th>' +
          '<th scope="col">Roll No</th>' +
          '<th scope="col">Address</th>' +

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

function addStudent() {
  var name = $("#rname").val();
  var course = $("#rcourse").val();
  var roll = $("#rroll").val();
  var sub = $("#rsub").val();
  var add = $("#radd").val();

  if (
    name == "" ||
    course == "" ||
    roll == "" ||
    sub == "" ||
    add == "") {
    alert("Fields should be blank!");
  } else {
    $.ajax({
      url: "../api/api.php",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      data: JSON.stringify({
        call: 6,
        name: name,
        course: course,
        roll: roll,
        sub: sub,
        add: add
      }),
      success: function (data) {
        var id = data[1];
        var pass = data[2];
        if (data[0] == 1) {
          getStudents();
          swal({
            title: "Thank you, "+name,
            text: "You are added on E-Attendance!\nId: "+id+"\nPassword: "+pass,
            icon: "success",
            button: "OK!",
          });

          $("#rname").val("");
          $("#rroll").val("");
          $("#rid").val("");
          $("#rpass").val("");
          $("#radd").val("");
        } 
        else if(data==2){
          swal({
            title: "Roll no already exists!",
            text: "Same roll numbers cannot be used in one course and subject!",
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
