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

    $sql1 = 'SELECT `user`.*, `profile`.* FROM `user`, `profile`WHERE user.user_id = profile.user_id;';
    $result1 = mysqli_query($conn, query: $sql1);

    $sql2 = 'SELECT * FROM comment';
    $result2 = mysqli_query($conn, query: $sql2);
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
        <div class="row justify-content-center align-items-center">
            <div class="col">
                <a href="user_admin.php" style="text-decoration: none; color:#000;">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">ผู้ใช้งาน</h4>
                            <div class="row justify-content-center align-items-center">
                                <?php $count = 0;
                                while ($data = mysqli_fetch_assoc($result1)) {
                                    if ($count >= 10) {
                                        break;
                                    }
                                ?>
                                    <div class="col-1 justify-content-center align-items-center text-center">
                                        <img src="<?php echo ($data['image'] != "" ? $data['image'] : 'img/prepro.jpg'); ?>" alt="Avatar" class="avatar" style="margin:auto;">
                                        <p><?php echo $data['user_n'] ?></p>
                                    </div>
                                <?php
                                    $count++;
                                } ?>
                                <small style="text-align: right;">เพิ่มเติม</small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3">
                <div class="card">
                    <a href="forum_admin.php">
                        <div class="card-body">
                            <h4 class="card-title">ตารางจัดการฟอรัม</h4>
                            <table class="table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">ไอดีผู้โพสต์</th>
                                        <th scope="col">หัวข้อฟอรัม</th>
                                        <th scope="col">ประเภทฟอรัม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count1 = 0;
                                    while ($data = mysqli_fetch_assoc($result)) {
                                        if ($count1 >= 10) {
                                            break;  // ถ้าแสดงครบ 10 แถวแล้ว หยุดการวนลูป
                                        } ?>
                                        <tr>
                                            <td><?php echo $data['user_id'] ?></td>
                                            <td><?php echo $data['fd_header'] ?></td>
                                            <td><?php echo $data['category_n'] ?></td>
                                        </tr>
                                    <?php
                                        $count1++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                </div>
                </a>
            </div>
            <div class="col mt-3">
                <div>
                    <div class="col">
                        <a href="comment_admin.php" style="text-decoration: none; color:#000;">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">ตารางจัดการความคิดเห็น</h4>
                                    <table class="table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">ไอดีฟอรัม</th>
                                                <th scope="col">ไอดีผู้โพสต์ความเห็น</th>
                                                <th scope="col">ความเห็น</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count1 = 0;
                                            while ($data = mysqli_fetch_assoc($result2)) {
                                                if ($count1 >= 10) {
                                                    break;  // ถ้าแสดงครบ 10 แถวแล้ว หยุดการวนลูป
                                                } ?>
                                                <tr>
                                                    <td><?php echo $data['f_id'] ?></td>
                                                    <td><?php echo $data['user_id'] ?></td>
                                                    <td><?php echo $data['ment_detail'] ?></td>
                                                </tr>
                                            <?php
                                                $count1++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </a>
                    </div>
                    <a href="category_admin.php" style="text-decoration: none; color:#000;">
                        <div class="mt-2">
                            <div class="col">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h4 class="card-title">ประเภทฟอรัม</h4>
                                        <i class="bi bi-heart-half icon-custom"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <script>
        document.title = "แดชบอร์ด";
    </script>
    <?php include('structure/footer.php') ?>