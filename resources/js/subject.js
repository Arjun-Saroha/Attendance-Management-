populateCourses();
getSubject();

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
        console.log(data);
        var courses = data;
        var course = '';
        var sr = 1;

        if(courses == 0){
            $("#course").html('<option>No course available at present.</option>');
        }
        else{
            $.each(courses, function (i, d) {
            course += 
                '<option value="'+d.name+' - '+d.duration+'">'+d.name+' - '+d.duration+'</option>';
        });
  
        $("#course").html('<option value="">Select Course</option>'+course);
        }
        
      },
    });
}

function getSubject() {
  var course = $("#course").val();
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
        console.log(data);
        var subjects = data;
        var subject = '';
        var sr = 1;

        if(subjects == 0){
            $("#subjectList").html('<p>No subjects available at present.');
        }
        else{
            $.each(subjects, function (i, d) {
                subject +=
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
                '<td scope="col">'+
                '<button class="btn btn-sm btn-danger" onclick="conFirm('+d.id+')" type="button">Remove</button>'+
                "</td>";
              sr++;
        });
  
        $("#subjectList").html(
          '<div class="table-responsive-md" style="background-color:white">' +
            '<table class="table table-bordered">' +
            "<thead>" +
            "<tr>" +
            '<th scope="col">Sr.no.</th>' +
            '<th colspan="2">Name</th>' +
            '<th scope="col">Course</th>' +
            '<th scope="col">Action</th>' +
            "</tr>" +
            "</thead>" +
            "<tbody>" +
            subject +
            "</tbody>" +
            "</table></div>"
        );
        }
        
      },
    });
}

$( "#course" ).change(function() {
    var name = $("#course").val();
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
            $("#subjectList").html('<p>No subjects available at present.');
        }
        else{
            $.each(subjects, function (i, d) {
                subject +=
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
                '<td scope="col">'+
                '<button class="btn btn-sm btn-danger" onclick="conFirm('+d.id+')" type="button">Remove</button>'+
                "</td>";
              sr++;
        });
  
        $("#subjectList").html(
          '<div class="table-responsive-md" style="background-color:white">' +
            '<table class="table table-bordered">' +
            "<thead>" +
            "<tr>" +
            '<th scope="col">Sr.no.</th>' +
            '<th colspan="2">Name</th>' +
            '<th scope="col">Course</th>' +
            '<th scope="col">Action</th>' +
            "</tr>" +
            "</thead>" +
            "<tbody>" +
            subject +
            "</tbody>" +
            "</table></div>"
        );
        }
      },
    });
  });

function addSubject() {
    
    var name = $("#name").val();
    var course = $("#course").val();
  
    if (
      name == "" ||
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
          call: 11,
          name: name,
          course: course
        }),
        success: function (data) {
          if (data == 1) {
            $("#name").val("");
            getSubject();
          } 
          else if(data==2){
            swal({
              title: "Subject already exists!",
              text: "Try another one!",
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

function conFirm(id)
  {
    var id = id;
    swal({
        title: 'Are you sure?',
        text: "Confirm once before deleting course!",
        icon: "warning",
        buttons: ['Cancel', 'Confirm'],
        dangerMode: true,
        })
        .then((ok) => {
        if (ok) {
            removeSubject(id);
        } else {
            swal("Think again!");
        }
    });
}

function removeSubject(id) {
    var id = id;
      
    $.ajax({
        url: "../api/api.php",
        type: "POST",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify({
          call: 12,
          id :id,
        }),
        success: function (data) {
          if (data == 1) {
            getSubject();
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



