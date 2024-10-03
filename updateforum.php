<?php

include("db.connect.php");
include("structure/header.php");
include("structure/navbar.php");

$sql = 'SELECT `forum`.*, `forum_detail`.*
FROM `forum` 
LEFT JOIN `forum_detail` ON `forum_detail`.`f_id` = `forum`.`f_id` WHERE forum.f_id=' . $_GET['f_id'];
$result = mysqli_query($conn, query: $sql);

$sql1 = 'SELECT * FROM category';
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
                    if ($_SESSION['role'] == '2') {
                        header('location:forum_admin.php');
                    } else {
                        header('location:profile.php');
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

<body>
    <div class="container mt-5">
        <div class="row g-2">
            <div class="col"></div>
            <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>แก้ไขฟอรัม <?php echo $data['fd_header'] ?> </h4>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="mb-3">
                                    <label for="" class="form-label">หัวข้อ</label>
                                    <input type="text" class="form-control " id="fd_header" name="fd_header"
                                        placeholder="กรอก หัวข้อ" value="<?php echo $data['fd_header'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">รายละเอียด</label>
                                    <textarea class="form-control" id="mytextarea" name="fd_content" rows="8"
                                        ><?php echo $data['fd_content'] ?></textarea>
                                </div>
                                <label for="" class="form-label">ประเภทฟอรัมของคุณ</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="category_id">
                                    <?php
                                    while ($data1 = mysqli_fetch_assoc($result1)) {
                                    ?>
                                        <option value="<?php echo $data1['category_id'] ?>"><?php echo $data1['category_n'] ?>
                                        </option>
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
                    </div>
                </div>
                <div class="col"></div>
            <?php
            }
            ?>
        </div>

    </div>
    <script>
        document.title = "แก้ไขฟอรัม";
    </script>
    <?php include('structure/footer.php') ?>