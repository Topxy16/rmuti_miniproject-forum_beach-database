<?php

include("db.connect.php");
include("navbar.php");


if ($_SESSION['role'] == 2) {
    $sql = 'SELECT `forum`.*, `forum_detail`.*,category.* 
    FROM `forum`, `forum_detail`,category 
    WHERE forum.f_id = forum_detail.f_id
    AND forum.category_id = category.category_id';
    $result = mysqli_query($conn, query: $sql);

    $sql1 = 'SELECT `user`.*, `profile`.* FROM `user`, `profile`WHERE user.user_id = profile.user_id;';
    $result1 = mysqli_query($conn, query: $sql1);
} else {
    echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'ไม่สามารถทำรายการได้',
            showConfirmButton: false,
            timer: 2000 })
            </script>";
    header("Refresh:2; url=index.php");
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard_Admin</title>

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


        .btn-color {
            background-color: #2A5360;
            color: #ffff;

        }

        .text-custom {
            text-align: right;
        }
    </style>
</head>

<body>


    <!-- ส่วนคอลั่ม ข้อมูล -->
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col">
                <a href="user_admin.php" style="text-decoration: none; color:#000;">
                    <div class="card border-dark">
                        <div class="card-body">
                            <h4 class="card-title">ผู้ใช้งาน</h4>
                            <div class="row justify-content-center align-items-center g-2">
                                <?php while ($data = mysqli_fetch_assoc($result1)) { ?>
                                    <div class="col-1 justify-content-center align-items-center text-center">
                                        <img src="img/qa.png" alt="Avatar" class="avatar" style="margin:auto;">
                                        <p><?php echo $data['user_n'] ?></p>
                                    </div>
                                <?php } ?>
                                <small class="text-custom">เพิ่มเติม</small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row justify-content-center align-items-center g-2 mt-3">
            <div class="col">
                <a href="forum_admin.php" style="text-decoration: none; color:#000;">
                    <div class="card border-dark">
                        <div class="card-body">
                            <h4 class="card-title">ตารางจัดการฟอรัม</h4>
                            <table class="table border-dark table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">ไอดีผู้โพสต์</th>
                                        <th scope="col">หัวข้อฟอรัม</th>
                                        <th scope="col">ประเภทฟอรัม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td><?php echo $data['user_id'] ?></td>
                                            <td><?php echo $data['fd_header'] ?></td>
                                            <td><?php echo $data['category_n'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col">
                        <div class="card border-dark">
                            <div class="card-body">
                                <h4 class="card-title">คอมเม้น</h4>
                                <i class="bi bi-chat-dots display-3"></i>
                                <p>
                                <h5>200</h5>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col">
                            <div class="card border-dark">
                                <div class="card-body">
                                    <h4 class="card-title">ประเภทฟอรัมที่นิยม</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- ส่วนคอลั่ม ข้อมูล -->

</body>

</html>