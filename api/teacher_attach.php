<?php
session_start();
include('connect.php');
        
if(isset($_POST['getFile'])){

    $date = $_POST['date'];
    $tid = $_SESSION['teacher'];
    $output = '';
    $sr = 1;
    $record = mysqli_query($con, "select student.name, student.course, student.subject, student.roll_no, record.date, record.record from student LEFT JOIN record ON student.id=record.sid LEFT JOIN faculty ON faculty.t_id=record.tid where record.date='$date' and record.tid='$tid'");

        if(mysqli_num_rows($record)>0){
            $output.=   '<table class="table" bordered="1">
                            <tr>
                                <th>Sr. No.</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Subject</th>
                                <th>Roll no</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>';
    
            while($row = mysqli_fetch_array($record)){
                if($row['record']==1){
                    $status = 'P';
                }
                else{
                    $status = 'A';
                }
                $output.=
                        '<tr>
                            <td>'.$sr.'</td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['course'].'</td>
                            <td>'.$row['subject'].'</td>
                            <td>'.$row['roll_no'].'</td>
                            <td>'.$row['date'].'</td>
                            <td>'.$status.'</td>
                        </tr>';
                        $sr++;
            }
            $output.= '</table>';
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=$date.xls");
            echo $output;
        }
}


    
?>