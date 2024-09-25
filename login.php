<?php
include("db.connect.php");
include("structure/header.php");


if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // ใช้ prepared statement สำหรับการตรวจสอบอีเมล
    $sql = 'SELECT * FROM user WHERE email = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); // "s" สำหรับ string
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data && $email == $data['email'] && md5($pass) == $data['pass']) {
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['role'] = $data['role'];
        header('location:index.php');
    } else {
        echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'ไม่สามารถทำรายการได้',
            showConfirmButton: false,
            timer: 2000 })
            </script>";
        // รอ 2 วินาทีแล้วกลับไปที่หน้า login
        header("Refresh:2; url=login.php");
    }
}
?>

<body>
    
    <div class="banner"><img src="img/banner.jpg" width="100%"></div>
    <?php include("structure/navbar.php"); ?>

        <div class="contrainer" style="margin-top: 100px;">
            <div class="row justify-content-center align-items-center g-2">
                <div class="col"></div>
                <div class="col-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h2 class="mb-5 mt-3" style="text-align: center;">ลงชื่อเข้าใช้งาน</h2>
                            </div>
                            <form method="post">
                                <div class="mb-3">
                                    <input type="email" class="form-control " id="email" name="email" aria-describedby="emailHelp" placeholder="อีเมล" required>
                                </div>
                                <div class="mb-3">

                                    <input type="password" class="form-control" id="pass" name="pass" placeholder="รหัสผ่าน" required>
                                </div>
                                <button type="submit" class="btn btn-color mb-3" style="width: 100%;">เข้าสู่ระบบ</button>
                            </form>
                            <div class="regis" style="text-align: center;">
                                ยังไม่เป็นสมาชิก? <a href="register.php" style="text-decoration: underline;">สมัคสมาชิก</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
            </div>
        </div>

    <?php include('structure/footer.php') ?>