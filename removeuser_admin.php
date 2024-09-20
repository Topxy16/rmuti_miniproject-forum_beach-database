<?php
    include("db.connect.php");
    include("structure/header.php");
    include("structure/navbar.php");
    
    $sql = 'DELETE FROM user WHERE `user`.`user_id` = '.$_GET['user_id'];
    mysqli_query($conn,$sql);
    header('location:user_admin.php');
?>