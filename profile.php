<?php

include("db.connect.php");
include("structure/header.php");
include("structure/navbar.php");

$sql = 'SELECT forum.*, forum_detail.*, category.*
        FROM forum
        INNER JOIN forum_detail ON forum.f_id = forum_detail.f_id
        INNER JOIN category ON forum.category_id = category.category_id
        WHERE forum.user_id = ' . $_SESSION['user_id'] . '
        ORDER BY forum_detail.fd_datetime DESC';

$result = mysqli_query($conn, query: $sql);

$sql1 = 'SELECT `user`.*, `profile`.* FROM `user`, `profile` WHERE user.user_id = profile.user_id AND user.user_id = "' . $_SESSION['user_id'] . '"';
$result1 = mysqli_query($conn, query: $sql1);
?>

<body>
    <div class="container">
        <?php
        while ($data = mysqli_fetch_assoc($result1)) {
        ?>
            <div class="row mt-2 justify-content-center align-items-center g-2">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            สมาชิกหมายเลข <?php echo $data['user_id'] ?>
                        </div>
                        <div class="row g-0">
                            <div class="col-1 d-flex">
                                <a href="imageprofile.php"><img
                                        src="<?php echo ($data['image'] != "" ? $data['image'] : 'img/prepro.jpg'); ?>"
                                        alt="Avatar" class="avatar"></a>
                            </div>
                            <div class="col">
                                <div class="card-body mb-3">
                                    <h5 class="card-title"><?php echo $data['user_n'] ?></h5>
                                    <p class="card-text"><?php echo $data['role'] == 2 ? "แอดมิน" : "ผู้ใช้งาน"; ?></p>
                                </div>
                            </div>
                            <div class="col d-flex align-items-end flex-column">
                                <a href="updateprofile.php?user_id=<?php echo $data['user_id'] ?>"
                                    class="btn btn-color w-10 mt-auto mb-2 mr-2"
                                    style="margin-right: 10px;">แก้ไขข้อมูลส่วนตัว</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php
        }
        ?>

        <div class="row justify-content-center align-items-center g-2">
            <div class="col"></div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        ฟอรัมของคุณ
                    </div>
                    <div class="card-body">
                        <?php
                        while ($data = mysqli_fetch_assoc($result)) {
                        ?>

                            <div class="row">
                                <div class="col">
                                    <a href="forum.php?f_id=<?php echo $data["f_id"] ?>">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $data['fd_header'] ?></h5>
                                            <div class="badge wrap-color text-wrap mb-3">
                                                <?php echo $data['category_n'] ?>
                                            </div>

                                            <div>
                                                <small class="">โพสต์เมื่อ :
                                                    <?php echo $data['fd_datetime'] ?>

                                                </small>
                                            </div>

                                        </div>
                                    </a>
                                </div>
                                <div class="col d-flex align-items-end justify-content-end">
                                    <a href="updateforum.php?f_id=<?php echo $data["f_id"] ?>" class="mb-2 mr-2"
                                        style="margin-right: 5px;"><i class="bi bi-pencil"></i></a>
                                    <a onclick="confirm(<?php echo $data['f_id'] ?>)" href="#" class="mb-2"
                                        style="margin-right: 10px;"><i class="bi bi-trash"></i></a>
                                </div>
                            </div>

                            <hr>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>

    </div>
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
        document.title = "โปรไฟล์";
    </script>
    <?php include('structure/footer.php') ?>