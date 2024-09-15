<?php

include("db.connect.php");
include("navbar.php");

$sql = 'SELECT * FROM forum_detail';
$result = mysqli_query($conn, query: $sql);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>หน้าแรก</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/offcanvas-navbar/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <link href="css/styles.css" rel=" stylesheet">
    <style>
        .avatar {
            
            width: 70px;
            height: 70px;
            border-radius: 50%;

            border-width: 1px;
            border-style: solid;
            border-color: black;

            margin-top: 15px;
            margin-bottom: auto;
            margin-left: 15px;
            margin-right: auto;
        }
    </style>
</head>

<body>


    <!-- ส่วนคอลั่ม ข้อมูล -->
    <div class="container">

        <h2 class ="mt-2">กระทู้น่าสนใจ</h2>
        
        <?php
        while ($data = mysqli_fetch_assoc($result)) {
        ?>
            <div class="row mt-2 justify-content-center align-items-center g-2">
                <div class="col"></div>
                <div class="col-10">
                    <div class="card border-dark mb-3">
                        <div class="row g-0">
                            <div class="col-1 d-flex">
                                <img src="img/qa.png" alt="Avatar" class="avatar">
                            </div>
                            <div class="col">
                    
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $data['fd_header'] ?></h5>
                                    <p class="card-text"><?php echo $data['fd_content'] ?></p>
                                    <!-- เส้นใต้จาง -->
                                    <div class="underline"></div>
                                    <!-- เพิ่มส่วนแสดงสถานะ -->
                                    <div class="align-items-center">
                                        <div class="vr"></div>
                                        <span class="card-text"><small class="text-body-secondary"><?php echo $data['fd_datetime'] ?></small></span>
                                    </div>
                                </div>

                
                              
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
            </div>
        <?php
        }
        ?>
    </div>
    <!-- ส่วนคอลั่ม ข้อมูล -->

</body>

</html>