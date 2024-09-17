<?php
    include('db.connect.php');
    $sql = 'DELETE FROM forum WHERE f_id  = '.$_GET['f_id'];
    mysqli_query($conn,$sql);
    header('location:profile.php');
?>