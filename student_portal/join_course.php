<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($servername, $username, $password,"oneclick");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_SESSION['login_user'];
    $get_sql = "SELECT StudentID FROM student WHERE email=\"$email\"";
    $res = mysqli_query($conn,$get_sql);
    if($res){
        $get_id = "tmp";
        while ($row=mysqli_fetch_row($res)){
            $get_id = $row[0];
        }
        $sql="SELECT FirstName,cn FROM instructor INNER JOIN (SELECT InstructorID, alias1.CourseName as cn FROM instructor_courses INNER JOIN (Select CourseName,CourseID from course WHERE CourseID NOT IN (SELECT CourseID FROM student_attendance WHERE StudentID = $get_id ))alias1 ON alias1.CourseID = instructor_courses.CourseID)alias2 ON alias2.InstructorID = instructor.InstructorID;";
        
        $result = mysqli_query($conn,$sql);

        if ($result)
        {

            echo "<form method= \"post\"";
            while ($row=mysqli_fetch_row($result))
            {
                $cour = $row['cn'];
                $prof = $row['FirstName'];
                echo "<input type=\"checkbox\" name=\"$cour\" value=\"$cour\"> Course: $cour - Instructor: $prof"; 
            }
            echo "</form>";
        }
        echo "No courses found";
    }else{
    
    }
    mysqli_close($conn);
?>
    
