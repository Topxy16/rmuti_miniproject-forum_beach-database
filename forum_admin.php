<?php

include("db.connect.php");
include("structure/header.php");
include("structure/navbar.php");

if ($_SESSION['role'] == 2) {

    $sql = 'SELECT `forum`.*, `forum_detail`.*,category.* 
    FROM `forum`, `forum_detail`,category 
    WHERE forum.f_id = forum_detail.f_id
    AND forum.category_id = category.category_id';
    $result = mysqli_query($conn, query: $sql);
    $count_f = mysqli_num_rows($result);
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
                                <small style="margin-left: 5px;">จำนวนฟอรัม</small>
                                <h4 style="margin-left: 5px;"><?php echo $count_f ?></h4>
                            </div>
                            <div class="col">
                                <p class="bi bi-pencil display-5" style="text-align:end"></p>
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
                        <h3>ตารางจัดการฟอรัม</h3>
                        <div class="table-responsive">
                            <table id="table" class="table table-hover">
                                <thead>
                                    <th>ไอดีผู้โพสต์</th>

                                    <th width="200px">หัวข้อฟอรัม</th>
                                    <th>เนื้อหาฟอรัม</th>
                                    <th>ประเภทฟอรัม</th>
                                    <th>โพสต์เมื่อ</th>
                                    <th>เครื่องมือ</th>
                                </thead>
                                <tbody>
                                    <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td><?php echo $data['user_id'] ?></td>

                                            <td><?php echo $data['fd_header'] ?></td>
                                            <td><textarea disabled cols="40"><?php echo $data['fd_content'] ?></textarea></td>
                                            <td><?php echo $data['category_n'] ?></td>
                                            <td><?php echo $data['fd_datetime'] ?></td>
                                            <td>
                                                <a href="updateforum.php?f_id=<?php echo $data['f_id'] ?>"
                                                    class="btn btn-dark mb-2 mr-2"
                                                    style="margin-right: 5px;"> แก้ไข </a>
                                                <a onclick="confirm(<?php echo $data['f_id'] ?>)" href="#"
                                                    class="btn btn-danger mb-2 mr-2"
                                                    style="margin-right: 5px;"> ลบ </a>

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
                    window.location.href = 'removeforum.php?f_id=' + id;
                }
            });
        }
    </script>
    <script>
        document.title = "ฟอรัม";
    </script>
    <?php include('structure/footer.php') ?>