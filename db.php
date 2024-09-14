<?php 
$hostname = "localhost";
$username = "root";
$userpassword = "newpassword";
$dbname = "STUFFY";

$conn = new mysqli($hostname, $username, $userpassword, $dbname);

if( $conn-> connect_error){
    die("connection failed". $conn->connect_error);
}else{
    echo "connection is successful";
}       

;