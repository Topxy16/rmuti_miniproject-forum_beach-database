<?php

include("db.connect.php");
include("navbar.php");

$sql = 'SELECT `forum`.*, `forum_detail`.*, `profile`.*
FROM `forum` 
INNER JOIN `forum_detail` ON `forum_detail`.`f_id` = `forum`.`f_id` 
INNER JOIN `profile` ON `forum`.`user_id` = `profile`.`user_id` WHERE forum.f_id=' . $_GET['f_id'];
$result = mysqli_query($conn, query: $sql);

$sql1 = 'SELECT `forum`.*, `category`.*
FROM `forum` 
LEFT JOIN `category` ON `forum`.`category_id` = `category`.`category_id`';
$result1 = mysqli_query($conn, query: $sql1);

if (!empty($_POST)) {
    $header = $_POST['fd_header'];
    $content = $_POST['fd_content'];
    $fid = $_GET['f_id'];

    $sql2 = 'UPDATE forum_detail SET fd_header = ?, fd_content = ? WHERE f_id = ?';
    $stmt = mysqli_prepare($conn, $sql2);

    $cateid = $_POST['category_id'];

    $sql3 = 'UPDATE forum SET category_id = ? WHERE f_id = ?';
    $stmt2 = mysqli_prepare($conn, $sql3);

    if ($stmt) {
        if ($stmt2) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, 'ssi', $header, $content, $fid);
            $result2 = mysqli_stmt_execute($stmt);

            mysqli_stmt_bind_param($stmt2, 'ii', $cateid, $fid);
            $result3 = mysqli_stmt_execute($stmt2);

            if ($result2) {
                if ($result3) {
                    header("location:profile.php");
                } else {
                    echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'ไม่สามารถทำรายการได้',
            showConfirmButton: false,
            timer: 2000 })
            </script>";
                }
            } else {
                echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'ไม่สามารถทำรายการได้',
            showConfirmButton: false,
            timer: 2000 })
            </script>";
            }

            // Close the statement
            mysqli_stmt_close($stmt);
            mysqli_stmt_close($stmt2);
        }
    } else {
        // Prepare failed
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'ไม่สามารถเตรียมคำสั่ง SQL ได้',
            footer: '<a href>Why do I have this issue?</a>'
        })</script>";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>

    </title>

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
        <div class="row mt-2 justify-content-center align-items-center g-2">
        
        <?php
            while ($data = mysqli_fetch_assoc($result)) {
            ?>
        
            <div class="col"></div>
                <div class="col-11">
                <h2>แก้ไขฟอรัม <?php echo $data['fd_header'] ?> </h2>
                    <form method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">หัวข้อ</label>
                            <input type="text" class="form-control " id="fd_header" name="fd_header" placeholder="กรอก หัวข้อ" value="<?php echo $data['fd_header'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">รายละเอียด</label>
                            <textarea class="form-control" id="fd_content" name="fd_content" rows="17" required><?php echo $data['fd_content'] ?></textarea>
                        </div>
                        <label for="" class="form-label">ประเภทกระทู้ของคุณ</label>
                        <select class="form-select mb-3" aria-label="Default select example" name="category_id">
                            <option selected>เลือกประเภทกระทู้ของคุณ</option>
                            <?php
                            while ($data = mysqli_fetch_assoc($result1)) {
                            ?>
                                <option value="<?php echo $data['category_id'] ?>"><?php echo $data['category_n'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <!-- <div class="mb-3">
                                <label for="formFile" class="form-label">รูป</label>
                                <input class="form-control" type="file" id="formFile">
                            </div> -->
                        <button type="submit" class="btn btn-color" style="width: 100%;">ยืนยัน</button>
                    </form>
                </div>
                <?php
            }
    ?>
                <div class="col"></div>
        </div>

    </div>
    <!-- ส่วนคอลั่ม ข้อมูล -->

</body>

</html>