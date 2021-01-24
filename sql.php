<?php


//$sql = "CREATE TABLE `register` (
//  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
//  `email` varchar(100) NOT NULL,
//  `password` varchar(100) NOT NULL
//)";

$host = 'localhost';
$username = 'root';
$password = '';
$dbase = 'webmini';

$conn = mysqli_connect($host, $username, $password, $dbase);

if ($conn) {
    echo "Successfully connected to server";
} else {
    echo "Failed";
}

//print(mysqli_query($conn, $sql));


