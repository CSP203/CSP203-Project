<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($servername, $username, $password,"id5418435_oneclick");
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
    {   ///CHANGE THE PATH OF SAVING AS PER THE HOSTING SERVER . NOW ITS REFERS TO MY PATH IN  MY COMPUTER
        printf("Course registered succesfully");
        $sDirPath = 'C:/xampp/htdocs/course/'.$register_course_name.'/'; //Specified Pathname
        $csvpath=    'C:/xampp/htdocs/course/'.$register_course_name.'/'.$register_course_name.'.csv';
        if (!file_exists ($sDirPath))

        {
              printf("Course folder created");
                mkdir($sDirPath,0777,true);  
        // open the file "demosaved.csv" for writing
        $file = fopen($csvpath, 'w');
 
        // save the column headers
        fputcsv($file, array('SerialNumber','EntryNumber', 'StudentName'));
 
        
        // Close the file
        fclose($file);        

        }   
        else
        {
            printf("Course folder not created");
        }
        exit();
    }
    else 
    {
        printf("Error occured,Please Retry\nRedirecting to signup page");
        echo "Error: " . $enter_data . "<br>" . $conn->error;
    }
    mysqli_close($conn);
?>
    
