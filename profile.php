<?php

include("db.connect.php");
include("structure/header.php");
include("structure/navbar.php");

$sql = 'SELECT `forum`.*, `forum_detail`.*,category.* 
FROM `forum`, `forum_detail`,category 
WHERE forum.f_id = forum_detail.f_id
AND forum.category_id = category.category_id
AND forum.user_id = "' . $_SESSION['user_id'] . '"';

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
                    <div class="card border-dark mb-3">
                        <div class="row g-0">
                            <div class="col-1 d-flex">
                                <a href="imageprofile.php"><img src="<?php echo $data['image'] ?>" alt="Avatar" class="avatar"></a>
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $data['user_n'] ?></h5>
                                    <p class="card-text"><?php echo $data['role'] == 2 ? "แอดมิน" : "ผู้ใช้งาน"; ?></p>

                                    <div class="underline">ไอดีของคุณ : <?php echo $data['user_id'] ?></div>
                                </div>
                            </div>
                            <div class="col d-flex align-items-end flex-column">
                                <a href="updateprofile.php?user_id=<?php echo $data['user_id']?>" class="btn btn-color w-10 mt-auto mb-2 mr-2"
                                    style="margin-right: 10px;">แก้ไขข้อมูลส่วนตัว</a>
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
                    <a href="forum.php?f_id=<?php echo $data["f_id"] ?>" style="text-decoration: none; color:black;">
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
                                <a href="updateforum.php?f_id=<?php echo $data["f_id"] ?>" class="btn btn-color mb-2 mr-2" style="margin-right: 5px;">แก้ไขฟอรัม</a>
                                <a onclick="confirm(<?php echo $data['f_id'] ?>)" href="#" class="btn btn-danger mb-2" style="margin-right: 10px;">ลบฟอรัม</a>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php
        }
        ?>
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
    <?php include('structure/footer.php') ?>