<?php
    include('db.connect.php');
    include('navbar.php');

    $sql = 'DELETE FROM forum WHERE f_id  = '.$_GET['f_id'];
    mysqli_query($conn,$sql);
    
    if($_SESSION['role']=='2'){
        header('location:forum_admin.php');
    }else{
        header('location:profile.php');
    }
    
?>