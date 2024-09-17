<?php

include("db.connect.php");
include("navbar.php");

$sql2 = 'SELECT * FROM user';
$result2 = mysqli_query($conn, $sql2);


if ($_SESSION['role'] == 2) {
    $sql = 'SELECT `forum`.*, `forum_detail`.*,category.* 
    FROM `forum`, `forum_detail`,category 
    WHERE forum.f_id = forum_detail.f_id
    AND forum.category_id = category.category_id
    AND forum.user_id = "' . $_SESSION['user_id'] . '"';

    $result = mysqli_query($conn, query: $sql);

    $sql1 = 'SELECT `user`.*, `profile`.* FROM `user`, `profile` WHERE user.user_id = profile.user_id AND user.user_id = "' . $_SESSION['user_id'] . '"';
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
    </style>
</head>

<body>


    <!-- ส่วนคอลั่ม ข้อมูล -->
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col">
                <div class="card border-dark">
                    <div class="card-body">
                        <h4 class="card-title">ผู้ใช้งาน</h4>
                        <div
                            class="row justify-content-center align-items-center g-2"
                        >
                        <?php for($i = 0; $i < 13; $i++){ ?>
                  <div class="col justify-content-center align-items-center text-center">
                  <img src="img/qa.png" alt="Avatar" class="avatar" style="margin:auto;">
                  ชื่อผู้ใช้งาน
                  </div>
                           
                            
                      <?php } ?>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center align-items-center g-2 mt-3">
            <div class="col">
                <div class="card border-dark">
                    <div class="card-body">
                        <h4 class="card-title">ตารางจัดการฟอรัม</h4>
                        <table class="table border-dark table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col">
                        <div class="card border-dark">
                            <div class="card-body">
                                <h4 class="card-title">คอมเม้น</h4>
                                <i class="bi bi-chat-dots display-3"></i>
                               <p><h5>200</h5></p>
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