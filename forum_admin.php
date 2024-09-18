<?php

include("db.connect.php");
include("navbar.php");


if ($_SESSION['role'] == 2) {

    $sql = 'SELECT `forum`.*, `forum_detail`.*,category.* 
    FROM `forum`, `forum_detail`,category 
    WHERE forum.f_id = forum_detail.f_id
    AND forum.category_id = category.category_id';
    $result = mysqli_query($conn, query: $sql);

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

    <title>ระบบจัดการฟอรัม</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/offcanvas-navbar/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <link href="css/styles.css" rel=" stylesheet">

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
        <!-- <div class="row justify-content-center align-items-center g-2">
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
                               
                                <h4 style="margin-left: 5px;"><?php echo $usercreateforum?></h4>
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
                                <h4 style="margin-left: 5px;"><?php echo $useruncreateforum?></h4>
                            </div>
                            <div class="col">
                                <p class="bi bi-file-x display-4 text-custom"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="row justify-content-center align-items-center g-2">
            <div class="col"></div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3>ฟอรัม</h3>
                        <div class="table-responsive">
                            <table class="table border-dark table-bordered table-hover">
                                <thead>
                                    <th>ไอดีผู้โพสต์</th>
                                    <th>ไอดีฟอรัม</th>
                                    <th>หัวข้อฟอรัม</th>
                                    <th>เนื้อหาฟอรัม</th>
                                    <th>ประเภทฟอรัม</th>
                                    <th>เครื่องมือ</th>
                                </thead>
                                <tbody>
                                    <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td width="100px"><?php echo $data['user_id'] ?></td>
                                            <td><?php echo $data['f_id'] ?></td>
                                            <td><?php echo $data['fd_header']?></td>
                                            <td><?php echo $data['fd_content'] ?></td>
                                            <td><?php echo $data['category_n'] ?></td>                                   
                                            <td width="140px">
                                                <a href="updateforum.php?f_id=<?php echo $data["f_id"] ?>"
                                                    class="btn btn-dark mb-2 mr-2"
                                                    style="margin-right: 5px;"
                                                    role="button"
                                                    data-bs-toggle="button"> แก้ไข </a>
                                                <a href="removeforum.php?f_id=<?php echo $data["f_id"] ?>"
                                                    class="btn btn-danger mb-2 mr-2"
                                                    style="margin-right: 5px;"
                                                    role="button"
                                                    data-bs-toggle="button"> ลบ </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>


    </div>
    <!-- ส่วนคอลั่ม ข้อมูล -->

</body>

</html>