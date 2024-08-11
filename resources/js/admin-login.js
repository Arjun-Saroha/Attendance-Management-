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
            call : 1,
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
               window.location = 'admin_dashboard.php';
            }
        }
        
    });
    }
}