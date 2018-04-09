<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($servername, $username, $password,"oneclick");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully";
    //echo "<br/>";
   
    //echo "<br/>";
    $signup_first_name=$_POST['first_name'];
    $signup_second_name=$_POST['second_name'];
    $signup_email=$_POST['email'];
    $signup_pass1=$_POST["pass1"];
    $signup_pass2=$_POST["pass2"];
    
    //printf("%s %s %s %s %s\n",$signup_first_name,$signup_second_name,$signup_email,$signup_pass1,$signup_pass2);
    $isValid="Select all email from instructor";
    //echo "<br>";    
    //echo $isValid;
    //echo "<br>";
    $result = mysqli_query($conn,$isValid);
    $count = mysqli_num_rows($result);
    if (mysqli_num_rows($result)>0)
    {
        //echo $count;
        //echo "<br/>";
        while ($row=mysqli_fetch_row($result))
        {
            //printf("Comparing given email %s with %s \n",$signup_email,$row[0]);
            //echo "<br/>";
            if (strcmp($row[0],$signup_email)==0)
            {
                printf("The Email ID provided is already registered to another user\n");
                //header("refresh: 5; signup.html");
                exit();
            }
        }
    }
    //data given is valid
    $enter_data="Insert into instructor(`IDPass`,`FirstName`,`LastName`,`email`) values('$signup_pass1','$signup_first_name','$signup_second_name','$signup_email')";
    $result=$conn->query($enter_data);
    //echo "<br/>";
        
    if ($result==true)
    {
        printf("Signed Up Sucessfully\n");
        //header("refresh: 5; signup.html");
    }
    else 
    {
        printf("Error occured,Please Retry\n");
        echo "Error: " . $enter_data . "<br>" . $conn->error;
        //header("refresh: 5; signup.html");
    }
    mysqli_close($conn);
?>