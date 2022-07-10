<?php
include("connection.php");

if (isset($_POST['sign_up'])) {

    // check if password are matching
    if ($_POST['user_password'] === $_POST['user_password2']) {

        // salt and dash password
        $pass = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
    } else {
        echo "<script>alert('Passwords are not matching')</script>";
        exit();
    }
    if (strlen($_POST['user_name']) > 11) {
        echo "<script>alert('Username should be maximum 11 characters!')</script>";
        echo "<script>window.open('signup.php', '_self')</script>";
        exit();
    }

    // store data in variables
    $name = htmlentities(mysqli_real_escape_string($connect, $_POST['user_name']));
    $country = htmlentities(mysqli_real_escape_string($connect, $_POST['user_country']));
    $email = htmlentities(mysqli_real_escape_string($connect, $_POST['user_email']));
    $password = htmlentities(mysqli_real_escape_string($connect, $pass));

    // check validation of email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Email is invalid..')</script>";
        echo "<script>window.open('signup.php', '_self')</script>";
        exit();
    }


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
    if (isset($_FILES["upload_ava"]["name"]) && !empty($_FILES["upload_ava"]["name"])) {
        $ava_file = ($_FILES["upload_ava"]["name"]);
        $ava_tmp = ($_FILES["upload_ava"]["tmp_name"]);
        $ava_size = ($_FILES["upload_ava"]["size"]);
        $ava_error = ($_FILES["upload_ava"]["error"]);
        $img_typ = strtolower(pathinfo("uploads/" . $ava_file, PATHINFO_EXTENSION));
        $allowed_typs = array("jpg", "jpeg", "png");

        if ($ava_error === 0) {
            if ($ava_size > 500000) {
                echo "<script>alert('Your file is too large, please try again!')</script>";
                echo "<script>window.open('signup.php', '_self')</script>";
                exit();
            } else {
                if (!in_array($img_typ, $allowed_typs)) {
                    echo "<script>alert('Sorry, only JPG, JPEG and PNG files are allowed!')</script>";
                    echo "<script>window.open('signup.php', '_self')</script>";
                    exit();
                } else {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_typ;
                    $img_path  = 'uploads/' . $new_img_name;
                    move_uploaded_file($ava_tmp, $img_path);

                    $insert = "INSERT INTO users (user_name, user_email, user_password, user_country, user_avatar, user_online) VALUES('$name', '$email', '$password', '$country', '$img_path', 0) ";
                    $query = mysqli_query($connect, $insert);

                    if ($query) {
                        error_reporting(0);
                        echo "<script>alert('Congratulations $name, your account has been creates successfully')</script>";
                        echo "<script>window.open('index.php', '_self')</script>";
                    } else {
                        echo "<script>alert('Registration failed, please try again!')</script>";
                        echo "<script>window.open('signup.php', '_self')</script>";
                        exit();
                    }
                }
            }
        } else {
            echo "<script>alert('Unknow error occurred, please try again!')</script>";
            echo "<script>window.open('signup.php', '_self')</script>";
            exit();
        }
    } else {
        // use default avatar
        $ava_path = "img/ava.png";
        $insert = "INSERT INTO users (user_name, user_email, user_password, user_country, user_avatar, user_online) VALUES('$name', '$email', '$password', '$country', '$ava_path', 0) ";
        $query = mysqli_query($connect, $insert);

        if ($query) {
            echo "<script>alert('Congratulations $name, your account has been creates successfully')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        } else {
            echo "<script>alert('Registration failed, please try again!')</script>";
            echo "<script>window.open('signup.php', '_self')</script>";
            exit();
        }
    }
}
