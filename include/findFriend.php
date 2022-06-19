<?php

include("connection.php");

function search_user($my_id)
{
    global $connect;

    if (isset($_GET['btn_find'])) {
        $txt_find = htmlentities($_GET['txt_find']);

        if (!empty($txt_find)) {
            $find_friend = "SELECT * FROM users WHERE user_email = '$txt_find'";
            $run_find = mysqli_query($connect, $find_friend);
            $row_find = mysqli_fetch_array($run_find);

            if ($row_find != null) {
                $find_id = $row_find['user_id'];
                $find_name = $row_find['user_name'];
                $find_ava = $row_find['user_avatar'];
                $find_country = $row_find['user_country'];

                if (!isFriendAlready($connect, $find_id, $my_id)) {
                    echo "
                    <div class='content' style='align-items: center; display: flex; justify-content: center; flex-flow: column;align-content: center;'>
                        <img src=$find_ava height='200px' width='200px'> 
                        <div class='details' style='margin-left: 0px; margin-top: 10px; display: grid; text-align: center;'> 
                        <span>$find_name</span>
                        <p>From: $find_country</p>
                        <form method='post'>
                        <button name='insert_Friend'>Chat with friend</button>
                        </form>                        
                        </div>
                    </div>
                    ";

                    if (isset($_POST['insert_Friend'])) {

                        $insert_friend_query = "INSERT INTO friends(user_one, user_two) VALUES('$my_id', '$find_id')";
                        mysqli_query($connect, $insert_friend_query);

                        echo "<script>window.open('chat.php?frd_id=$find_id', '_self')</script>";
                    }
                } else {
                    echo "<script>alert('You guys have already a conversation'); </script>";
                }
            } else {
                echo "<script>alert('No user was found :('); </script>";
            }
        } else {
            echo "<script>alert('Please enter email address to find your friend!'); </script>";
        }
    }
}
