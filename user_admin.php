<?php

include("db.connect.php");
include("navbar.php");


if ($_SESSION['role'] == 2) {
    $sql = 'SELECT `user`.*, `profile`.* FROM `user`, `profile`WHERE user.user_id = profile.user_id;';
    $result = mysqli_query($conn, query: $sql);

    $sql1 = 'SELECT * FROM user;';
    $result1 = mysqli_query($conn, $sql1);
    $usercount = mysqli_num_rows($result1);

    $sql2 = 'SELECT DISTINCT user_id FROM forum;';
    $result2 = mysqli_query($conn, $sql2);
    $usercreateforum = mysqli_num_rows($result2);

    $sql3 = 'SELECT `user`.*, `forum`.*
FROM `user` 
LEFT JOIN `forum` ON `forum`.`user_id` = `user`.`user_id`
WHERE forum.f_id IS NULL;';
    $result3 = mysqli_query($conn, $sql3);
    $useruncreateforum = mysqli_num_rows($result3);
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

    <title>ระบบจัดการผู้ใช้งาน</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/offcanvas-navbar/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <link href="css/styles.css" rel=" stylesheet">
    <link href="css/table.css" rel=" stylesheet">

    <style>
        .btn-color {

            background-color: #2A5360;
            color: #ffff;
        }

        .text-custom {
            text-align: right;

        }

        .card-count {
            height: 110px;
        }

        
    </style>

</head>

<body>


    <!-- ส่วนคอลั่ม ข้อมูล -->
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col">
                <div class="card card-count">
                    <div class="card-body">
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">
                                <small style="margin-left: 5px;">จำนวนผู้ใช้งาน</small>

                                <h4 style="margin-left: 5px;"><?php echo $usercount ?></h4>
                            </div>
                            <div class="col">
                                <p class="bi bi-person display-4 text-custom"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-count">
                    <div class="card-body">
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">
                                <small style="margin-left: 5px;">เคยสร้างฟอรัมแล้ว</small>

                                <h4 style="margin-left: 5px;"><?php echo $usercreateforum ?></h4>
                            </div>
                            <div class="col">
                                <p class="bi bi-file-text display-4 text-custom"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-count">
                    <div class="card-body">
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">
                                <small style="margin-left: 5px;">ยังเคยสร้างฟอรัม</small>
                                <h4 style="margin-left: 5px;"><?php echo $useruncreateforum ?></h4>
                            </div>
                            <div class="col">
                                <p class="bi bi-file-x display-4 text-custom"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
        <div class="row justify-content-center align-items-center g-2">
            <div class="col"></div>
            <div class="col-12">
                <div class="table">
                    <table>
                        <tr class="head">
                            <th width="200px">ไอดีผู้ใช้งาน</th>
                            <th>อีเมล</th>
                            <th>สถานะ</th>
                            <th>ชื่อผู้ใช้งาน</th>
                            <th width="200px">เครื่องมือ</th>
                            <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                        <tr class="table-row">
                            <td width="100px"><?php echo $data['user_id'] ?></td>
                            <td><?php echo $data['email'] ?></td>
                            <td><?php echo $data['role'] == 2 ? "แอดมิน" : "ผู้ใช้งานทั่วไป"; ?></td>
                            <td><?php echo $data['user_n'] ?></td>
                            <td width="140px">
                                <a href="updateuser_admin.php?user_id=<?php echo $data["user_id"] ?>"
                                    class="btn btn-dark mb-2 mr-2"
                                    style="margin-right: 5px;"
                                    role="button"
                                    data-bs-toggle="button"> แก้ไข </a>
                                <a href="removeuser_admin.php?user_id=<?php echo $data["user_id"] ?>"
                                    class="btn btn-danger mb-2 mr-2"
                                    style="margin-right: 5px;"
                                    role="button"
                                    data-bs-toggle="button"> ลบ </a>
                            </td>
                        </tr>
                        </tr>
                    <?php } ?>
                    </tr>
                    </table>
                </div>
            </div>
            <div class="col"></div>
        </div>

    </div>
    <!-- ส่วนคอลั่ม ข้อมูล -->

</body>

</html>