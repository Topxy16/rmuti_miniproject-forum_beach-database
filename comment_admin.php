<?php

include("db.connect.php");
include("structure/header.php");
include("structure/navbar.php");

if ($_SESSION['role'] == 2) {

    $sql = 'SELECT * FROM comment';
    $result = mysqli_query($conn, query: $sql);
    $count_m = mysqli_num_rows($result);
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
    <!-- ส่วนคอลั่ม ข้อมูล -->
    <div class="container mt-3">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col">
                <div class="card card-count">
                    <div class="card-body">
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">
                                <small style="margin-left: 5px;">จำนวนความคิดเห็น</small>
                                <h4 style="margin-left: 5px;"><?php echo $count_m ?></h4>
                            </div>
                            <div class="col">
                                <p class="bi bi-chat display-5" style="text-align:end"></p>
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
                        <h3>ตารางจัดการความคิดเห็น</h3>
                        <div class="table-responsive">
                            <table id="table" class="table">
                                <thead>
                                    <th>ไอดีความเห็น</th>
                                    <th>ไอดีผู้โพสต์ความเห็น</th>
                                    <th>ไอดีฟอรัม</th>
                                    <th>ความเห็น</th>
                                    <th>วันเวลา</th>
                                    <th>เครื่องมือ</th>
                                </thead>
                                <tbody>
                                    <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td><?php echo $data['ment_id'] ?></td>
                                            <td><?php echo $data['user_id'] ?></td>
                                            <td><?php echo $data['f_id'] ?></td>
                                            <td><textarea disabled cols="40"><?php echo $data['ment_detail'] ?></textarea></td>
                                            <td><?php echo $data['ment_datetime'] ?></td>
                                            <td width="140px">
                                                <a href="updatecomment.php?ment_id=<?php echo $data['ment_id'] ?>&f_id=<?php echo $data['f_id'] ?>"
                                                    class="btn btn-dark mb-2 mr-2"
                                                    style="margin-right: 5px;"> แก้ไข </a>
                                                <a onclick="confirm(<?php echo $data['ment_id'] ?>)" href="#"
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
    <!-- ส่วนคอลั่ม ข้อมูล -->
    <script rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirm(m_id, f_id) {
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
                    window.location.href = 'removement.php?ment_id=' + m_id + '&f_id=' + f_id;
                }
            });
        }
    </script>
    <script>
        document.title = "ความคิดเห็น";
    </script>

    <?php include('structure/footer.php') ?>