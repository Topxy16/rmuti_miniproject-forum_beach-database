<?php

include("db.connect.php");
include("structure/header.php");
include("structure/navbar.php");


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

<body>
    <div class="container mt-3">
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
                                <p class="bi bi-person display-4 " style="text-align: right;"></p>
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
                                <p class="bi bi-file-text display-4" style="text-align: right;"></p>
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
                                <small style="margin-left: 5px;">ยังไม่เคยสร้างฟอรัม</small>
                                <h4 style="margin-left: 5px;"><?php echo $useruncreateforum ?></h4>
                            </div>
                            <div class="col">
                                <p class="bi bi-file-x display-4" style="text-align: right;"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center align-items-center g-2">
            <div class="col"></div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3>ตารางจัดการผู้ใช้งาน</h3>
                        <div class="table-responsive">
                            <table id="table" class="table table-hover">
                                <thead>
                                    <th width="200px">ไอดีผู้ใช้งาน</th>
                                    <th>อีเมล</th>
                                    <th>สถานะ</th>
                                    <th>ชื่อผู้ใช้งาน</th>
                                    <th width="200px">เครื่องมือ</th>
                                </thead>
                                <tbody>
                                    <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td width="100px"><?php echo $data['user_id'] ?></td>
                                            <td><?php echo $data['email'] ?></td>
                                            <td><?php echo $data['role'] == 2 ? "แอดมิน" : "ผู้ใช้งานทั่วไป"; ?></td>
                                            <td><?php echo $data['user_n'] ?></td>
                                            <td width="140px">
                                                <a href="updateuser_admin.php?user_id=<?php echo $data["user_id"] ?>"
                                                    class="btn btn-dark mb-2 mr-2"
                                                    style="margin-right: 5px;"> แก้ไข </a>
                                                <a onclick="confirm(<?php echo $data['user_id'] ?>)" href="#"
                                                    class="btn btn-danger mb-2 mr-2"> ลบ </a>
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
    <script rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirm(id) {
            console.log(id)
            Swal.fire({
                title: "คุณยืนยันที่จะทำรายการหรือไม่",
                text: "คุณจะไม่สามารถย้อนกลับสิ่งที่ทำได้",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "ยกเลิก",
                confirmButtonText: "ยืนยัน"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'removeuser_admin.php?user_id=' + id;
                }
            });
        }
    </script>
        <script>
            document.title = "ผู้ใช้งาน";
        </script>
<?php include('structure/footer.php') ?>