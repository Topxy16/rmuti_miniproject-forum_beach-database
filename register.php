<?php
include("navbar.php");
include("db.connect.php");

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $usern = $_POST['user_n'];

    // ตรวจสอบว่ามีอีเมลนี้อยู่แล้วหรือไม่โดยใช้ prepared statement
    $sql = 'SELECT * FROM user WHERE email = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); // "s" สำหรับ string
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($email == @$data['email']) {
        echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'ไม่สามารถทำรายการได้',
            showConfirmButton: false,
            timer: 2000 })
            </script>";
    } else {
        // ใช้ prepared statement สำหรับการเพิ่มข้อมูลเข้าไปในตาราง user
        $sql = 'INSERT INTO user (email, pass, role) VALUES (?, ?, "1")';
        $stmt = $conn->prepare($sql);
        $hashed_pass = md5($pass);
        $stmt->bind_param("ss", $email, $hashed_pass); // "ss" สำหรับสอง string
        $stmt->execute();
        $user_id = $conn->insert_id; // เก็บค่า user_id หลังจาก insert

        // ใช้ prepared statement สำหรับการเพิ่มข้อมูลเข้าไปในตาราง profile
        $sql1 = 'INSERT INTO profile (user_n, image, user_id) VALUES (?, "", ?)';
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("si", $usern, $user_id); // "si" สำหรับ string และ integer
        $stmt1->execute();

        // เปลี่ยนเส้นทางไปที่หน้า login
        header('location:login.php');
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัคสมาชิก</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="contrainer mt-5">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col"></div>
            <div class="col-3">
                <div class="card border-dark">
                    <div class="card-body">
                        <div class="card-title">
                            <h2>สมัคสมาชิก</h2>
                        </div>
                        <form method="post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">อีเมล</label>
                                <input type="email" class="form-control " id="email" name="email" aria-describedby="emailHelp" placeholder="กรอก อีเมล" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">ชื่อผู้ใช้</label>
                                <input type="text" class="form-control " id="user_n" name="user_n" aria-describedby="" placeholder="กรอก ชื่อผู้ใช้" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">รหัสผ่าน</label>
                                <input type="password" class="form-control" id="pass" name="pass" placeholder="กรอก รหัสผ่าน" required>
                            </div>
                            <button type="submit" class="btn btn-success" style="width: 100%;">ยืนยัน</button>
                        </form>
                        <a href="login.php" class="btn btn-primary w-100 mt-2" role="button" data-bs-toggle="button">เข้าสู่ระบบ</a>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>

</html>