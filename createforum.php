<?php

include("db.connect.php");
include("structure/header.php");
include("structure/navbar.php");

if (!empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    if (isset($_POST['fd_header'])) {
        $category_id = $_POST['category_id'];
        $fd_header = $_POST['fd_header'];
        $fd_content = $_POST['fd_content'];
        $fd_datetime = date("Y-m-d H:i:s");  // ใช้เพื่อกำหนดเวลาปัจจุบัน

        // Insert ข้อมูลเข้าสู่ตาราง forum โดยใช้ prepared statement
        $sql1 = "INSERT INTO forum (user_id, category_id) VALUES (?, ?)";
        $stmt1 = mysqli_prepare($conn, $sql1);

        if ($stmt1) {
            mysqli_stmt_bind_param($stmt1, 'ii', $user_id, $category_id);
            $result1 = mysqli_stmt_execute($stmt1);

            if ($result1) {
                // ดึง f_id ที่เพิ่งถูกสร้างจากตาราง forum
                $f_id = mysqli_insert_id($conn);

                // Insert ข้อมูลเข้าสู่ตาราง forum_detail โดยใช้ f_id ที่เพิ่งได้มา
                $sql2 = "INSERT INTO forum_detail (fd_header, fd_content, fd_datetime, f_id) VALUES (?, ?, ?, ?)";
                $stmt2 = mysqli_prepare($conn, $sql2);

                if ($stmt2) {
                    mysqli_stmt_bind_param($stmt2, 'sssi', $fd_header, $fd_content, $fd_datetime, $f_id);
                    $result2 = mysqli_stmt_execute($stmt2);

                    if ($result2) {
                        header('Location: index.php');
                        exit(); // ใช้ exit() เพื่อหยุดการทำงานของสคริปต์หลังจากการเปลี่ยนเส้นทาง
                    } else {
                        echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูลใน forum_detail: " . mysqli_error($conn);
                    }

                    mysqli_stmt_close($stmt2);
                } else {
                    echo "ไม่สามารถเตรียมคำสั่ง SQL สำหรับ forum_detail ได้: " . mysqli_error($conn);
                }
            } else {
                echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูลใน forum: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt1);
        } else {
            echo "ไม่สามารถเตรียมคำสั่ง SQL สำหรับ forum ได้: " . mysqli_error($conn);
        }
    }
} else {
    echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'กรุณาล็อกอิน',
            showConfirmButton: false,
            timer: 2000 })
            </script>";
    header("Refresh:2; url=login.php");
}

// ดึงข้อมูลหมวดหมู่
$sql3 = "SELECT * FROM category";
$result3 = mysqli_query($conn, $sql3);

?>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col"></div>
            <div class="col-11">
                <h2>โพสต์ฟอรัม</h2>
                <form method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">หัวข้อ</label>
                        <input type="text" class="form-control " id="fd_header" name="fd_header" placeholder="กรอก หัวข้อ" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">รายละเอียด</label>
                        <textarea class="form-control" id="fd_content" name="fd_content" rows="17" required></textarea>
                    </div>
                    <label for="" class="form-label">ประเภทฟอรัมของคุณ</label>

                    <select class="form-select mb-3" aria-label="Default select example" name="category_id" required>

                        <?php
                        while ($data = mysqli_fetch_assoc($result3)) {
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
            <div class="col"></div>
        </div>
    </div>

<?php include('structure/footer.php') ?>