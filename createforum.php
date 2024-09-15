<?php

include("navbar.php");
include("db.connect.php");
$sql3 = "SELECT * FROM category";
$result3 = mysqli_query($conn, $sql3);

if (isset($_POST['fd_header'])) {
    // ดึง user_id จาก session
    $user_id = $_SESSION['user_id'];
    $category_id = $_POST['category_id'];
    $fd_header = mysqli_real_escape_string($conn, $_POST['fd_header']);
    $fd_content = mysqli_real_escape_string($conn, $_POST['fd_content']);
    $fd_datetime = date("Y-m-d H:i:s");  // ใช้เพื่อกำหนดเวลาปัจจุบัน

    // Insert ข้อมูลเข้าสู่ตาราง forum
    $sql1 = "INSERT INTO forum (user_id, category_id) VALUES ('$user_id', '$category_id')";

    $result1 = mysqli_query($conn, $sql1);

    // ดึง f_id ที่เพิ่งถูกสร้างจากตาราง forum
    $f_id = mysqli_insert_id($conn);

    if ($f_id) {
        // Insert ข้อมูลเข้าสู่ตาราง forum_detail โดยใช้ f_id ที่เพิ่งได้มา
        $sql2 = "INSERT INTO forum_detail (fd_header, fd_content, fd_datetime, f_id) 
                 VALUES ('$fd_header', '$fd_content', '$fd_datetime', '$f_id')";
        $result2 = mysqli_query($conn, $sql2);

        if ($result2) {
            header('Location: index.php');
        } else {
            echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูลใน forum_detail";
        }
    } else {
        echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูลใน forum";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เขียนกระทู้</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <div class="contrainer mt-5">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col"></div>
            <div class="col">
                <div class="card border-dark">
                    <div class="card-body">
                        <div class="card-title">
                            <h2>เขียนกระทู้</h2>
                        </div>
                        <form method="post">
                            <div class="mb-3">
                                <label for="" class="form-label">หัวข้อ</label>
                                <input type="text" class="form-control " id="fd_header" name="fd_header" placeholder="กรอก หัวข้อ" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">รายละเอียด</label>
                                <textarea class="form-control" id="fd_content" name="fd_content" rows="3" required></textarea>
                            </div>
                            <label for="" class="form-label">ประเภทกระทู้ของคุณ</label>

                            <select class="form-select mb-3" aria-label="Default select example" name="category_id">
                                <option selected>เลือกประเภทกระทู้ของคุณ</option>
                                <?php
                                while ($data = mysqli_fetch_assoc($result3)) {
                                ?>
                                    <option value="<?php echo $data ['category_id'] ?>"><?php echo $data ['category_n'] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                            <!-- <div class="mb-3">
                                <label for="formFile" class="form-label">รูป</label>
                                <input class="form-control" type="file" id="formFile">
                            </div> -->
                            <button type="submit" class="btn btn-success" style="width: 100%;">ยืนยัน</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">

            </div>
        </div>
    </div>
</body>

</html>