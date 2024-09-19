<?php

include("db.connect.php");
include("navbar.php");

$sql = 'SELECT `forum`.*, `forum_detail`.*,category.* 
FROM `forum`, `forum_detail`,category 
WHERE forum.f_id = forum_detail.f_id
AND forum.category_id = category.category_id
AND forum.user_id = "' . $_SESSION['user_id'] . '"';

$result = mysqli_query($conn, query: $sql);

$sql1 = 'SELECT `user`.*, `profile`.* FROM `user`, `profile` WHERE user.user_id = profile.user_id AND user.user_id = "' . $_SESSION['user_id'] . '"';
$result1 = mysqli_query($conn, query: $sql1);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ข้อมูลส่วนตัว</title>

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


        .btn-color {
            background-color: #2A5360;
            color: #ffff;
            
        }
    </style>
</head>

<body>


    <!-- ส่วนคอลั่ม ข้อมูล -->
    <div class="container">
        <?php
        while ($data = mysqli_fetch_assoc($result1)) {
        ?>
            <div class="row mt-2 justify-content-center align-items-center g-2">

                <div class="col-12">
                    <div class="card border-dark mb-3">
                        <div class="row g-0">
                            <div class="col-1 d-flex">
                                <img src="img/qa.png" alt="Avatar" class="avatar">
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $data['user_n'] ?></h5>
                                    <p class="card-text"><?php echo $data['role'] == 2 ? "แอดมิน" : "ผู้ใช้งาน"; ?></p>

                                    <div class="underline">ไอดีของคุณ : <?php echo $data['user_id'] ?></div>

                                </div>
                            </div>
                            <div class="col d-flex align-items-end flex-column">
                                <a href="updateprofile" class="btn btn-color w-10 mt-auto mb-2 mr-2"
                                    style="margin-right: 10px;" role="button" data-bs-toggle="button">แก้ไขข้อมูลส่วนตัว</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php
        }
        ?>
        <h2>ฟอรัมของคุณ</h2>
        <?php
        while ($data = mysqli_fetch_assoc($result)) {
        ?>
            <div class="row mt-2 justify-content-center align-items-center g-2">

                <div class="col-12">
                <a href="forum.php?f_id=<?php echo $data["f_id"]?>" style="text-decoration: none; color:black;">
                    <div class="card border-dark mb-3">
                        <div class="row g-0">
                            <div class="col-1 d-flex">
                                <img src="img/qa.png" alt="Avatar" class="avatar">
                            </div>
                            <div class="col">

                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $data['fd_header'] ?></h5>
                                    <p class="card-text"><?php echo $data['fd_content'] ?></p>  
                                    <div class="align-items-center">
                                      
                                        <span class="card-text"><small
                                                class="text-body-secondary">โพสต์เมื่อ : <?php echo $data['fd_datetime'] ?> <?php echo $data['category_n'] ?></small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col d-flex justify-content-end align-items-end" style="height: 100%;">
                            <a href="updateforum.php?f_id=<?php echo $data["f_id"]?>" class="btn btn-color mb-2 mr-2" style="margin-right: 5px;" role="button" data-bs-toggle="button">แก้ไขฟอรัม</a>
                            <a href="removeforum.php?f_id=<?php echo $data["f_id"]?>" class="btn btn-danger mb-2" style="margin-right: 10px;" role="button" data-bs-toggle="button">ลบฟอรัม</a>
                        </div>


                    </div>
        </a>
                </div>

            </div>
        <?php
        }
        ?>
    </div>
    <!-- ส่วนคอลั่ม ข้อมูล -->

</body>

</html>