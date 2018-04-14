<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
$test_string="well this is a test string";


if (isset($_POST['submit']) ) {
    if (empty($_POST['email']) || empty($_POST['pass'])) 
    {
        $error = "Username or Password is invalid";
    }
    else
    {
        // Define $username and $password
        $username=$_POST['email'];
        $password=$_POST['pass'];
        // Establishing Connection with Server by passing server_name, user_id and password as a parameter
        $host="localhost";
        $host_user="root";
        $host_pass="";
        $connection = mysqli_connect($host, $host_user, $host_pass,"oneclick");
        if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

        // To protect MySQL injection for Security purpose
        $username = stripslashes($username);
        $password = stripslashes($password);
        //$username = mysqli_real_escape_string($username);
        //$password = mysqli_real_escape_string($password);
        // SQL query to fetch information of registerd users and finds user match.
        $query = mysqli_query($connection,"Select * from instructor where instructor.email='$username' and instructor.IDPass='$password'" );
        $rows = mysqli_num_rows($query);
        if ( $rows == 1) 
        {
            $_SESSION['login_user']=$username; // Initializing Session
            $test_string="Redirecting";
            header("location: index.php"); // Redirecting To Other Page
        } 
        else 
        {
            $error = "Username or Password is invalid";
        }
        mysqli_close($connection); // Closing Connection

    }
}
?>
<?php


