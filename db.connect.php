<?php
$host = "127.0.0.1";
$user = "root";
$pw = "";
$db = "forumbeach_ej01";

$conn = new mysqli($host,$user,$pw,$db);

if($conn->connect_error){
    die("connect fail".$conn->connect_error);
}
?>