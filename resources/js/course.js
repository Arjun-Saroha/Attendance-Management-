getCourse();

function getCourse() {
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
            $("#courseList").html('<p>No courses available at present.');
        }
        else{
            $.each(courses, function (i, d) {
            course +=
                "<tr>" +
                '<th scope="row">' +
                sr +
                "</th>" +
                '<td colspan="2">' +
                d.name +
                "</td>" +
                '<td scope="col">' +
                d.duration +
                "</td>" +
                '<td scope="col">'+
                '<button class="btn btn-sm btn-danger" onclick="conFirm('+d.id+')" type="button">Remove</button>'+
                "</td>";
              sr++;
        });
  
        $("#courseList").html(
          '<div class="table-responsive-md" style="background-color:white">' +
            '<table class="table table-bordered">' +
            "<thead>" +
            "<tr>" +
            '<th scope="col">Sr.no.</th>' +
            '<th colspan="2">Name</th>' +
            '<th scope="col">Duration</th>' +
            '<th scope="col">Action</th>' +
            "</tr>" +
            "</thead>" +
            "<tbody>" +
            course +
            "</tbody>" +
            "</table></div>"
        );
        }
        
      },
    });
}

function addCourse() {
    
    var name = $("#name").val();
    var duration = $("#duration").val();
  
    if (
      name == "" ||
      duration == ""
      ) {
      alert("Fields should be blank!");
    } else {
      $.ajax({
        url: "../api/api.php",
        type: "POST",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify({
          call: 9,
          name: name,
          duration: duration
        }),
        success: function (data) {
          if (data == 1) {
            $("#name").val("");
            $("#duration").val("");
            getCourse();
          } 
          else if(data==2){
            swal({
              title: "Course already exists!",
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
            removeCourse(id);
        } else {
            swal("Think again!");
        }
    });
}

function removeCourse(id) {
    var id = id;
      
    $.ajax({
        url: "../api/api.php",
        type: "POST",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify({
          call: 10,
          id :id,
        }),
        success: function (data) {
          if (data == 1) {
            getCourse();
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