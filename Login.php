<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($servername, $username, $password,"oneclick");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
    echo "<br/>";
   
    echo "<br/>";
    $login_email=$_POST['email'];
    $login_pass=$_POST["pass"];
    echo $login_email;
    $isValid="Select email,IDpass from instructor where instructor.email='$login_email'";
    //$isValid1="Select * from instructor where email='mukesh123@iitrpr.ac.in'";
    echo "<br>";    
    echo $isValid;
    echo "<br>";
    echo "<br>";
    $result = mysqli_query($conn,$isValid);
    $count = mysqli_num_rows($result);
    if (mysqli_num_rows($result)==1)
    {
        echo $count;
        echo "<br/>";
        if ($row=mysqli_fetch_row($result))
        {
            if (strcmp($row[0],$login_email)!=0)
            {
                printf("Incorrect Email ID %s %s\n",$login_email,$row[0] );
                //header("refresh: 3; login.html");     //3 means wait 3 seconds and redirect to login.html
               // exit();
            }
            else if (strcmp($row[1],$login_pass)!=0)
            {
                printf("Incorrect Password\n" );
                //header("refresh: 3; login.html");
                //exit();
            }
            else
            {
                printf( "Success\n" );
                //header("refresh: 3; signup.html");
                //exit();
            }
        }
    }
    else
    {
        printf( "Make sure the email ID provided is correct\n" );
        echo $count;
        echo "<br/>";
        header("refresh: 5; login.html");
         exit();
    }
    mysqli_close($conn);
?>