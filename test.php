<?php
include("connection.php");


// $all_friends = "SELECT * FROM friends WHERE user_one = '10' OR user_two = '10' ";
// $run_all_friends = mysqli_query($connect, $all_friends);
// // $return_data = [];
// while ($row_friend = mysqli_fetch_array($run_all_friends)) {
//     $user_one = $row_friend['user_one'];
//     $user_two = $row_friend['user_two'];
//     if ($user_one == '10') {
//         $get_friends = "SELECT * FROM users WHERE user_id = '$user_two'";
//         $run_get_friends = mysqli_query($connect, $get_friends);
//         while ($row_get_friends = mysqli_fetch_array($run_get_friends)) {
//             $frd_name = $row_get_friends['user_name'];
//             $frd_ava = $row_get_friends['user_avatar'];
//             $frd_status = $row_get_friends['user_online'];

//             echo "
//                 <li>
//                 <div class='content'>
// 							<div class='details'>  
//                                     <span>User: $frd_name</span>";
//             if ($frd_status == 1) {
//                 echo "<p>Online</p>";
//             } else {
//                 echo "<p>Offline</p>";
//             }
//             "                           
// 							</div>
// 						</div>
//                 </li>
//             ";
//         }
//     }
// }

$sql = "SELECT * FROM users WHERE user_country = 'Vietnam' ";
$run = mysqli_query($connect, $sql);

// while ($row = mysqli_fetch_array($run)) {
//     $items[$row['user_id']] = array('id' => $row['user_id'], 'name' => $row['user_name'], 'ava' => $row['user_avatar'], 'country' => $row['user_country']);
// }

// $shuffle = shuffle($items);
// // foreach ($items as $values) {
// //     echo "$values" . "<br>";
// // }

// echo "<pre>";
// print_r($items);
// echo "</pre>";

$items = array();
if (mysqli_num_rows($run) > 0) {
    while ($row = mysqli_fetch_assoc($run)) {
        $items[] = $row;
    }
}

shuffle($items);

foreach ($items as $item) {
    $name = $item['user_name'];
    echo "$name" . "<br>";
}
