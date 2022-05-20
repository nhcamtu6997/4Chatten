<?php
session_start();

include("connection.php");

if(isset($_POST['log_in'])) {

    // store data in variables
    $email = htmlentities(mysqli_real_escape_string($connect, $_POST['user_email'])); 
    $password = htmlentities(mysqli_real_escape_string($connect, $_POST['user_password'])); 

    // check if user and email exist
    $check_user_query = "SELECT * FROM users WHERE user_email = '$email' AND user_password = '$password'";
    $check_user = mysqli_query($connect, $check_user_query);
    $check_user_result = mysqli_num_rows($check_user);

    if($check_user_result == 1) {
        $_SESSION['user_email'] = $email;

        // update status online 
        mysqli_query($connect, "UPDATE users SET user_online = 1 WHERE user_email = '$email'");

        // get name and ID of user
        $get_user = mysqli_query($connect, "SELECT * FROM users WHERE user_email = '$email'");
        $row = mysqli_fetch_array($get_user);
        $user_name = $row['user_name'];
        $user_id = $row['user_id'];

        echo "<script>window.open('homechat.php?id=$user_id', '_self')</script>";

    } else {

        echo "<div class='error-txt'>Email address or password not found!</div>";
  
    }

}

?>