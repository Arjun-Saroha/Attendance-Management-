function loginFun() {
  var uid = $("#uid").val();
  var pass = $("#pass").val();

  if (uid == "" || pass == "") {
    alert("Fields cannot be empty!");
  } else {
    $.ajax({
      url: "api/api.php",
      type: "POST",
      dataType: "json",
      contentType: "application/json",
      data: JSON.stringify({
        call: 2,
        uid: uid,
        pass: pass,
      }),
      success: function (data) {
        if (data == 1) {
          window.location = "routes/main.php";
        } else {
          swal({
            title: "Invalid credentials!",
            text: "Enter proper details!",
            icon: "error",
            button: "OK!",
          });
        }
      },
    });
  }
}
