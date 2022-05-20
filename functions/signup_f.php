<?php
include("connection.php");

if(isset($_POST['sign_up'])){

    // check if password are matching
    if($_POST['user_password'] === $_POST['user_password2']) {
        $matchpass = $_POST['user_password'];
    }else {
        echo "<script>alert('Password are not matching')</script>";
        echo "<script>window.open('signup.php', '_self')</script>";
        exit();
    }

    $name = htmlentities(mysqli_real_escape_string($connect, $_POST['user_name'])); 
    $country = htmlentities(mysqli_real_escape_string($connect, $_POST['user_country'])); 
    $email = htmlentities(mysqli_real_escape_string($connect, $_POST['user_email'])); 
    $pass = htmlentities(mysqli_real_escape_string($connect, $matchpass)); 
    $avatar = "images/ava.png";
    
    $insert = "insert into users (user_name, user_email, user_password, user_country, user_avatar) values ('$name', '$email', '$pass', '$country', '$avatar') ";

    $query = mysqli_query($connect, $insert);

    if($query) {
        echo "<script>alert('Successfully')</script>";
        echo "<script>window.open('signup.php', '_self')</script>";
    }


}




?>