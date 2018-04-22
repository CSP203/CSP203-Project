<?php
    session_start();
    $userEmail=$_SESSION['login_user'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($servername, $username, $password,"oneclick");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $register_course_name=$_POST['course_name'];
    $register_course_title=$_POST['course_title'];
    $isValid="Select CourseName from course where course.CourseName='$register_course_name'";
    $result = mysqli_query($conn,$isValid);
    
    if ($result)
    {
        while ($row=mysqli_fetch_row($result))
        {
            if (strcmp($row[0],$register_course_name)==0)
            {
                printf("course already exist");
                exit();
            }
        }
    }

    $enter_data="Insert into course(`CourseName`,`CourseTitle`) values('$register_course_name','$register_course_title')";
    $result=$conn->query($enter_data);
    if ($result==true)
    {   printf("Course registered succesfully");
        //UPDATING THE INSTRUCTOR COURSE TABLE
        //printf($userEmail);
        //printf($register_course_name);
        $result1 = mysqli_query($conn,"Select InstructorID from instructor where instructor.email='$userEmail'");
        $result2 = mysqli_query($conn,"Select CourseID from course where course.CourseName='$register_course_name'");
        if($result1 and $result2)
        {   $row1=mysqli_fetch_row($result1);
            $row2=mysqli_fetch_row($result2);
            $InstructorID=$row1[0];
            $CourseID=$row2[0];
            $result3=$conn->query("Insert into instructor_courses(`CourseID`,`InstructorID`) values('$CourseID','$InstructorID')");
            if($result3==true)
            {
                printf("Data inserted into instructor_course table");
            }
            else
            {
                printf("error while inserting into instructor_course table");   
            }
        }
        else{
            printf("Connection problem.Entry not reflected in instructorCourse table");
        }
        ///CHANGE THE PATH OF SAVING AS PER THE HOSTING SERVER . NOW ITS REFERS TO MY PATH IN  MY COMPUTER
        
        $sDirPath = 'C:/xampp/htdocs/course/'.$register_course_name.'/'; //Specified Pathname
        $csvpath=    'C:/xampp/htdocs/course/'.$register_course_name.'/'.$register_course_name.'.csv';
        if (file_exists ($sDirPath))
        {printf("Folder for this course is already exist ");
         }
         else{    
              mkdir($sDirPath,0777,true);
              printf("Course folder created"); 
         }      
        // open the file  for writing
        $file = fopen($csvpath, 'w');
 
        // save the column headers
        fputcsv($file, array('SerialNumber','EntryNumber', 'StudentName'));
        printf("Course CSV FILE created");
        
        // Close the file
        fclose($file);        

        exit();
    }
    else 
    {
        printf("Error occured,Please Retry\n");
        echo "Error: " . $enter_data . "<br>" . $conn->error;
    }
    mysqli_close($conn);
?>
    
