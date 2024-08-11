<?php

// SESSION START
session_start();

// IMPORT DATABASE CONNECTION FILE
include('connect.php');

// DECODE JSON DATA
$json = json_decode(file_get_contents("php://input"),true);




// ADMIN LOGIN
if($json['call']==1){
    $id = $json['id'];
    $pass = $json['pass'];

    $admin_id = 1234;
    $admin_pass = 1234;

    if($id == $admin_id and $pass == $admin_pass){
        $_SESSION['admin']=$id;
        echo json_encode(1);
    }
    else{
        echo json_encode(0);
    }
}



// GET COURSES
if($json['call']==2){
    $courses = mysqli_query($con, "select id, name, duration from course");
    if(mysqli_num_rows($courses)>0){
        $course = mysqli_fetch_all($courses, MYSQLI_ASSOC);
        $empty = mysqli_free_result($courses);
        echo json_encode($course);
    }
    else{
        echo json_encode(0);
    }
}



// GET SUBJECTS
if($json['call']==3){
    $course = $json['course'];
    $subjects = mysqli_query($con, "select id, name, course from subject where course='$course'");
    if(mysqli_num_rows($subjects)>0){
        $subject = mysqli_fetch_all($subjects, MYSQLI_ASSOC);
        $empty = mysqli_free_result($subjects);
        echo json_encode($subject);
    }
    else{
        echo json_encode(0);
    }
}



// GET SUBJECTS ON CHANGE OF COURSE
if($json['call']==4){
    $name = $json['name'];
    $subjects = mysqli_query($con, "select id, name, course from subject where course='$name'");
    if(mysqli_num_rows($subjects)>0){
        $subject = mysqli_fetch_all($subjects, MYSQLI_ASSOC);
        $empty = mysqli_free_result($subjects);
        echo json_encode($subject);
    }
    else{
        echo json_encode(0);
    }
}



// GET STUDENTS IN ADMIN DASHBOARD
if($json['call']==5){
    $getStudents = mysqli_query($con, "select name, roll_no, course, subject, address from student");
    if(mysqli_num_rows($getStudents)>0){
        $students = mysqli_fetch_all($getStudents, MYSQLI_ASSOC);
        $empty = mysqli_free_result($getStudents);
        echo json_encode($students);
    }
    else{
        echo json_encode($response['success']=0);
    }
}



// ADD NEW STUDENT
if($json['call']==6){

    $name = $json['name'];
    $course = $json['course'];
    $roll = $json['roll'];
    $sub = $json['sub'];
    $add = $json['add'];

    $id = mt_rand(10000,99999);
    $n = 8;
    function getPass($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@$';
        $randomString = '';

        for($i = 0; $i<$n; $i++){
            $index = rand(0, strlen($characters) - 1);
            $randomString.= $characters[$index];
        }
        return $randomString;
    }
    $pass = getPass($n);

    $check = mysqli_query($con, "select * from student where roll_no='$roll' and subject='$sub' and course='$course' ");
    if(mysqli_num_rows($check)>0){
        echo json_encode(2);
    }
    else{
        $query = mysqli_query($con, "insert into student (name, roll_no, course, subject, s_id, password, address) values('$name','$roll','$course','$sub','$id','$pass','$add')");
        if($query){
            echo json_encode([1, $id, $pass]);
        }
        else{
            echo json_encode(0);
        }
    }
}



// GET TEACHERS IN ADMIN DASHBOARD
if($json['call']==7){
    $getTeachers = mysqli_query($con, "select name, designation, course, subject from faculty");
    if(mysqli_num_rows($getTeachers)>0){
        $teachers = mysqli_fetch_all($getTeachers, MYSQLI_ASSOC);
        $empty = mysqli_free_result($getTeachers);
        echo json_encode($teachers);
    }
    else{
        echo json_encode($response['success']=0);
    }
}



// ADD NEW TEACHER
if($json['call']==8){

    $name = $json['name'];
    $des = $json['des'];
    $sub = $json['sub'];
    $course = $json['course'];

    $id = mt_rand(10000,99999);
    $n = 8;
    function getPass($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@$';
        $randomString = '';

        for($i = 0; $i<$n; $i++){
            $index = rand(0, strlen($characters) - 1);
            $randomString.= $characters[$index];
        }
        return $randomString;
    }
    $pass = getPass($n);

    $check = mysqli_query($con, "select * from faculty where course='$course' and subject='$sub' ");
    if(mysqli_num_rows($check)>0){
        echo json_encode(2);
    }
    else{
        $query = mysqli_query($con, "insert into faculty (name, designation, course, subject, t_id, password) values('$name','$des', '$course', '$sub','$id', '$pass')");
        if($query){
            echo json_encode([1, $id, $pass]);
        }
        else{
            echo json_encode(0);
        }
    }
}



// ADD NEW COURSE
if($json['call']==9){

    $name = $json['name'];
    $duration = $json['duration'];

    $check = mysqli_query($con, "select * from course where name='$name' and duration='$duration'");
    if(mysqli_num_rows($check)>0){
        echo json_encode(2);
    }
    else{
        $query = mysqli_query($con, "insert into course (name, duration) values('$name','$duration')");
        if($query){
            echo json_encode(1);
        }
        else{
            echo json_encode(0);
        }
    }
}



// REMOVE COURSE
if($json['call']==10){

    $id = $json['id'];
    $delete = mysqli_query($con, "delete from course where id ='$id' ");
    if($delete){
        echo json_encode(1);
    }
    else{
        echo json_encode(0);
    }
}



// ADD NEW SUBJECT
if($json['call']==11){

    $name = $json['name'];
    $course = $json['course'];

    $check = mysqli_query($con, "select * from subject where name='$name' and course='$course'");
    if(mysqli_num_rows($check)>0){
        echo json_encode(2);
    }
    else{
        $query = mysqli_query($con, "insert into subject (name, course) values('$name','$course')");
        if($query){
            echo json_encode(1);
        }
        else{
            echo json_encode(0);
        }
    }
}



// REMOVE SUBJECT
if($json['call']==12){

    $id = $json['id'];
    $delete = mysqli_query($con, "delete from subject where id ='$id' ");
    if($delete){
        echo json_encode(1);
    }
    else{
        echo json_encode(0);
    }
}



// GET ATTENDANCE RECORD IN ADMIN DASHBOARD
if($json['call']==13){

    $query = mysqli_query($con, "select student.id, student.name, student.roll_no, student.course, student.subject, record.sid, record.status, record.date, record.record from student LEFT JOIN record ON student.id = record.sid where student.id=record.sid ORDER BY record.date DESC");
    if(mysqli_num_rows($query)>0){
        $records = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $empty = mysqli_free_result($query);
        echo json_encode($records);
    }
    else{
        echo json_encode(0);
    }
}



// STUDENT LOGIN
if($json['call']==14){
    $id = $json['id'];
    $pass = $json['pass'];

    $check = mysqli_query($con, "select * from student where s_id='$id' and password='$pass'");
    if(mysqli_num_rows($check)>0){
        $detail = mysqli_query($con, "select id, name, roll_no, course, subject, address from student where s_id = '$id' and password='$pass' ");
        $data = mysqli_fetch_array($detail);
        $_SESSION['student'] = $data['id'];
        $_SESSION['studentname'] = $data['name'];
        $_SESSION['roll'] = $data['roll_no'];
        $_SESSION['course'] = $data['course'];
        $_SESSION['subject'] = $data['subject'];
        $_SESSION['address'] = $data['address'];
        echo json_encode(1);
    }
    else{
        echo json_encode(0);
    }
    
}



// GET ATTENDANCE RECORD IN STUDENT DASHBOARD
if($json['call']==15){

    $sid = $_SESSION['student'];
    $query = mysqli_query($con, "select student.id, student.name, student.roll_no, student.course, student.subject, record.sid, record.status, record.date, record.record from student LEFT JOIN record ON student.id = record.sid where record.sid='$sid' ORDER BY record.id DESC");
    if(mysqli_num_rows($query)>0){
        $records = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $empty = mysqli_free_result($query);
        echo json_encode($records);
    }
    else{
        echo json_encode(0);
    }
}



// TEACHER LOGIN
if($json['call']==16){
    $id = $json['id'];
    $pass = $json['pass'];

    $check = mysqli_query($con, "select * from faculty where t_id='$id' and password='$pass'");
    if(mysqli_num_rows($check)>0){
        $_SESSION['teacher']=$id;
        $detail = mysqli_query($con, "select name, designation, course, subject from faculty where t_id='$id' and password='$pass' ");
        $data = mysqli_fetch_array($detail);
        $_SESSION['teachername'] = $data['name'];
        $_SESSION['designation'] = $data['designation'];
        $_SESSION['subject'] = $data['subject'];
        $_SESSION['course'] = $data['course'];

        echo json_encode(1);
    }
    else{
        echo json_encode(0);
    }
    
}



// GET STUDENTS IN TEACHER DASHBOARD
if($json['call']==17){
    $day = date('d');
    $month = date('m');
    $year = date('Y');
    $date = [$day, $month, $year];
    $todayDate = date('d-m-Y');

    $subject = $_SESSION['subject'];
    $course = $_SESSION['course'];

    $getStudents = mysqli_query($con, "select student.id, student.name, student.roll_no, student.course, student.subject, record.sid, record.status, record.record, record.day, record.month, record.year, record.date from student LEFT JOIN record ON student.id = record.sid LEFT JOIN faculty ON faculty.subject=student.subject where student.subject='$subject' and student.course='$course' ORDER BY student.id ASC");
    if(mysqli_num_rows($getStudents)>0){
        $students = mysqli_fetch_all($getStudents, MYSQLI_ASSOC);
        $empty = mysqli_free_result($getStudents);
        echo json_encode([$students, $date, $todayDate]);
    }
    else{
        echo json_encode($response['success']=0);
    }
}



// ADD ATTENDANCE RECORD
if($json['call']==18){

    $sid = $json['sid'];
    $record = $json['record'];
    $day = date('d');
    $month = date('m');
    $year = date('Y');
    $date = date('d-m-Y');
    $tid = $_SESSION['teacher'];

    $changeStatus = mysqli_query($con,"update record set status=0 where sid=$sid");
    if($changeStatus){
        $query = mysqli_query($con, "insert into record (sid, tid, status, record, date, day, month, year) values('$sid', '$tid', 1 , '$record', '$date', '$day', '$month', '$year')");
        if($query){
            echo json_encode($response['success']=1);
        }
        else{
            echo json_encode($response['success']=0);
        }
    }
    
}



// GET ATTENDANCE RECORD IN TEACHER DASHBOARD
if($json['call']==19){

    $tid = $_SESSION['teacher'];
    $query = mysqli_query($con, "select student.id, student.name, student.roll_no, student.course, student.subject, record.sid, record.status, record.date, record.record from student LEFT JOIN record ON student.id = record.sid LEFT JOIN faculty ON faculty.id=record.tid where record.tid='$tid' ORDER BY record.id DESC");
    if(mysqli_num_rows($query)>0){
        $records = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $empty = mysqli_free_result($query);
        echo json_encode($records);
    }
    else{
        echo json_encode(0);
    }

   
}


?>