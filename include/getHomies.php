<?php

$sql = "SELECT * FROM users WHERE user_country = '$my_country' AND user_id != '$my_id' LIMIT 10; ";
$run = mysqli_query($connect, $sql);
$items = array();

if (mysqli_num_rows($run) > 0) {
    while ($row = mysqli_fetch_assoc($run)) {
        $items[] = $row;
    }
} else {
    echo "
    <div class='child'>
        <div class='details'>
            <span>No homies today :(</span>
        </div>
    </div>
";
}

shuffle($items);

foreach ($items as $item) {
    $id = $item['user_id'];
    $ava = $item['user_avatar'];
    $name = $item['user_name'];
    $country = $item['user_country'];

    if (!isFriendAlready($connect, $id, $my_id) && !isBlockFriends($connect, $id, $my_id)) {
        echo "
            <div class='child'>
                <img src=$ava alt=''>
                <div class='details'>
                    <span>$name</span>
                    <p>$country</p>
                    <button><a href='findhomies.php?insert=$id'>Chat now</a></button>
                </div>
            </div>
        ";
    }
}


if (isset($_GET['insert'])) {
    global $connect;
    $homie_id = $_GET['insert'];
    $query = "INSERT INTO friends(user_one, user_two) VALUES('$my_id', '$homie_id')";
    mysqli_query($connect, $query);

    echo "<script>window.open('chat.php?frd_id=$homie_id', '_self')</script>";
}
