<?php 
$hostname = "localhost";
$username = "root";
$userpassword = "1234";
$dbname = "store1";

$conn = new mysqli($hostname, $username, $userpassword, $dbname);

if( $conn-> connect_error){
    die("connection failed". $conn->connect_error);
}else{
    echo "connection is successful";
}       

