<?php

$hostName = "localhost:3307";
$dbUser = "root";
$dbPassword="";
$dbName = "login_register";
// $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

try {
    $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
} 

catch (mysqli_sql_exception $e) {
    die("Something went wrong");
   // echo "MySQLi Error: " . $e->getMessage();
}



// if(!$conn){
//     die("Something went wrong");
// }

?>