<?php

include("db.connect.php");
include("structure/header.php");
include("structure/navbar.php");

$fid = $_GET['f_id'];

$sql = 'SELECT `forum`.*, `category`.*, `forum_detail`.*, `forum_image`.*, `profile`.*
FROM `forum` 
	LEFT JOIN `category` ON `forum`.`category_id` = `category`.`category_id` 
	LEFT JOIN `forum_detail` ON `forum_detail`.`f_id` = `forum`.`f_id` 
	LEFT JOIN `forum_image` ON `forum_image`.`f_id` = `forum`.`f_id`
	LEFT JOIN `profile` ON `profile`.`user_id` = `forum`.`user_id`
    WHERE forum.f_id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $fid);
$stmt->execute();
$result = $stmt->get_result();


$sql1 = 'SELECT `forum`.*, `comment`.*
FROM `forum` 
LEFT JOIN `comment` ON `comment`.`f_id` = `forum`.`f_id`
WHERE forum.f_id = ?';
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param('i', $fid);
$stmt1->execute();
$result1 = $stmt1->get_result();


$sql3 = 'SELECT `comment`.*, `user`.*
FROM `comment` 
	LEFT JOIN `user` ON `comment`.`user_id` = `user`.`user_id` 
    WHERE user.user_id = ?';
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param('i', $_SESSION['user_id']);
$stmt3->execute();
$result3 = $stmt3->get_result();


if (isset($_POST['ment_detail'])) {
    $userid = $_SESSION['user_id'];
    $mentdetail = $_POST['ment_detail'];
    $mentdate = date("Y-m-d H:i:s");

    $sql2 = 'INSERT INTO comment (user_id, f_id, ment_detail, ment_status, ment_img, ment_datetime) VALUES (?, ?, ?, "1", NULL, ?)';
    $stmt2 = $conn->prepare($sql2);
    if ($stmt2) {
        $stmt2->bind_param('iiss', $userid, $fid, $mentdetail, $mentdate);
        $result2 = mysqli_stmt_execute($stmt2);
        if ($result2) {
            echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'ทำรายการสำเร็จ',
            showConfirmButton: false,
            timer: 2000 })
            </script>";
            header("Refresh:2;");
            exit();
        } else {
            echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'ทำรายการไม่สำเร็จ',
            showConfirmButton: false,
            timer: 2000 })
            </script>";
            header("Refresh:2;");
        }
    }
}

?>

<body>
    <div class="container">
        <?php
        while ($data = mysqli_fetch_assoc($result)) {
        ?>
            <div class="row mt-2 justify-content-center align-items-center g-2">
                <div class="col"></div>
                <div class="col-10">
                    <div class="card border-dark mb-3">
                        <div class="row g-0">
                            <div class="col-1 d-flex">
                                <img src="img/qa.png" alt="Avatar" class="avatar">
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title"><b><?php echo $data['fd_header'] ?></b></h5>
                                    <span class="card-text"><small class="text-body-secondary"><?php echo $data['category_n'] ?></small></span>
                                    <p class="card-text"><?php echo $data['fd_content'] ?></p>
                                    <img src="<?php echo $data['image']?>" alt="" style="max-width: 100%; height: 400px; ">
                                    <div class="underline"></div>
                                    <div class="align-items-center">
                                        <div class="vr"></div>
                                        <span class="card-text"><small class="text-body-secondary"><?php echo $data['fd_datetime'] ?></small></span>
                                        <span class="card-text"><small class="text-body-secondary">ผู้โพสต์ <?php echo $data['user_n'] ?></small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
            </div>
            <?php while ($data = mysqli_fetch_assoc($result1)) { ?>
                <?php if (!empty($data['f_id'])) { ?>

                    <div class="row justify-content-center align-items-center g-2 mt-2">

                        <div class="col"></div>
                        <div class="col-10">

                            <div class="card border-dark">
                                <div class="card-body">
                                    <p class="card-text"><?php echo $data['ment_detail'] ?></p>
                                    <small class="text-body-secondary"> โพสต์เมื่อ : <?php echo $data['ment_datetime'] ?> | ความเห็นจากสามาชิกหมายเลข : <?php echo $data['user_id'] ?> </small>
                                    <?php if (@$_SESSION['user_id'] == @$data['user_id']) { ?>
                                        <div style="text-align: right">
                                            <a href="updatecomment.php?ment_id=<?php echo $data['ment_id'] ?>&f_id=<?php echo $_GET['f_id'] ?>" style="text-decoration: none; color:black;"><i class="bi bi-pencil"></i></a>
                                            <a onclick="confirm(<?php echo $data['ment_id'] ?>,<?php echo $data['f_id'] ?>)" href="#"
                                                style="text-decoration: none; color:black;">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col"></div>
                    </div>
                <?php } ?>
            <?php } ?>
            <div class="row justify-content-center align-items-center g-2 mt-3">
                <div class="col"></div>
                <div class="col-10">
                    <div class="card border-dark">
                        <div class="card-body">
                            <form method="post">
                                <textarea name="ment_detail" id="ment_detail" cols="100" rows="5"></textarea>
                                <button type="submit" class="btn btn-success" style="width: 25%;">เพิ่มความเห็น</button>
                                <small>สมาชิกหมายเลข : <?php echo $_SESSION['user_id'] ?></small>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
            </div>
        <?php
        }
        ?>
    </div>
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

    <?php include('structure/footer.php') ?>