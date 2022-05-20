<?php

// class Database {

//     function connect_to_db(){
//         $connect = mysqli_connect("localhost", "root", "", "chatten_db") or die("Connection was not established");
//         // host, username, password, dbname
//         return $connect;
//     }

//     function save($query) {
//         $conn = $this->connect_to_db();
//         $result = mysqli_query($conn, $query);
        
//         if(!$result) {
//             return false;
//         }else {
//             return true;
//         }
//     }

//     function read($query) {
//         $conn = $this->connect_to_db();
//         $result = mysqli_query($conn, $query);
        
//         if(!$result) {
//             return false;
//         }else {
//             $data = false;
//             while($row = mysqli_fetch_assoc($result))
//             {
//                 $data[] = $row;
//             }
//             return $data;
//         }
//     }

// }


$connect = mysqli_connect("localhost", "root", "", "chatten_db") or die("Connection was not established");

?>
