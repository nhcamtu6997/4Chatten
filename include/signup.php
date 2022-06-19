<?php
include("connection.php");

if (isset($_POST['sign_up'])) {

    // check if password are matching
    if ($_POST['user_password'] === $_POST['user_password2']) {
        $matchpass = $_POST['user_password'];
    } else {
        echo "<script>alert('Password are not matching')</script>";
        echo "<script>window.open('signup.php', '_self')</script>";
        exit();
    }

    // store data in variables
    $name = htmlentities(mysqli_real_escape_string($connect, $_POST['user_name']));
    $country = htmlentities(mysqli_real_escape_string($connect, $_POST['user_country']));
    $email = htmlentities(mysqli_real_escape_string($connect, $_POST['user_email']));
    $password = htmlentities(mysqli_real_escape_string($connect, $matchpass));



    // check if email exist
    $check_email_query = "SELECT * FROM users WHERE user_email = '$email'";
    $check_email = mysqli_query($connect, $check_email_query);
    $check_email_result = mysqli_num_rows($check_email);

    if ($check_email_result != NULL) {
        echo "<script>alert('Email is already exist, please try again!')</script>";
        echo "<script>window.open('signup.php', '_self')</script>";
        exit();
    }

    // save data into database
    if (isset($_FILES["upload_ava"]["name"]) and !empty($_FILES["upload_ava"]["name"])) {
        $avatar_file = "uploads/" . basename($_FILES["upload_ava"]["name"]);
        $avatar_tmp = "uploads/" . basename($_FILES["upload_ava"]["tmp_name"]);
        $random_number = rand(1, 100);
        $imageFileType = strtolower(pathinfo($avatar_file, PATHINFO_EXTENSION));

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "<script>alert('Sorry, only JPG, JPEG and PNG files are allowed!')</script>";
            echo "<script>window.open('signup.php', '_self')</script>";
        } else {
            move_uploaded_file($avatar_tmp, "$random_number.$avatar_file");

            $insert = "INSERT INTO users (user_name, user_email, user_password, user_country, user_avatar) VALUES('$name', '$email', '$password', '$country', '$random_number.$avatar_file') ";

            $query = mysqli_query($connect, $insert);

            if ($query) {
                echo "<script>alert('Congratulations $name, your account has been creates successfully')</script>";
                echo "<script>window.open('index.php', '_self')</script>";
            } else {
                echo "<script>alert('Registration failed, please try again!')</script>";
                echo "<script>window.open('signup.php', '_self')</script>";
            }
        }
    } else {

        // use default avatar
        $avatar = "img/ava.png";
        $insert = "INSERT INTO users (user_name, user_email, user_password, user_country, user_avatar) VALUES('$name', '$email', '$password', '$country', '$avatar') ";

        $query = mysqli_query($connect, $insert);

        if ($query) {
            echo "<script>alert('Congratulations $name, your account has been creates successfully')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        } else {
            echo "<script>alert('Registration failed, please try again!')</script>";
            echo "<script>window.open('signup.php', '_self')</script>";
        }
    }
}
