<?php

include("db.connect.php");
include("structure/header.php");
include("structure/navbar.php");

if ($_SESSION['role'] == 2) {
    $sql = 'SELECT `user`.*, `profile`.* FROM `user`, `profile` WHERE user.user_id = profile.user_id AND user.user_id = ' . $_GET['user_id'];
    $result = mysqli_query($conn, $sql);

    if (!empty($_POST)) {
        $email = $_POST['email'];
        $userid = $_GET['user_id'];
        $usern = $_POST['user_n'];
        $pass = !empty($_POST['pass']) ? md5($_POST['pass']) : null;

        // Prepare the SQL statements
        if ($pass) {
            $sql2 = 'UPDATE user SET email = ?, pass = ? WHERE user_id = ?';
            $stmt = mysqli_prepare($conn, $sql2);
            mysqli_stmt_bind_param($stmt, 'ssi', $email, $pass, $userid);
        } else {
            $sql2 = 'UPDATE user SET email = ? WHERE user_id = ?';
            $stmt = mysqli_prepare($conn, $sql2);
            mysqli_stmt_bind_param($stmt, 'si', $email, $userid);
        }

        $sql3 = 'UPDATE profile SET user_n = ? WHERE user_id = ?';
        $stmt2 = mysqli_prepare($conn, $sql3);
        mysqli_stmt_bind_param($stmt2, 'si', $usern, $userid);

        if ($stmt && $stmt2) {
            $result2 = mysqli_stmt_execute($stmt);
            $result3 = mysqli_stmt_execute($stmt2);

            if ($result2 && $result3) {
                header("location:user_admin.php");
            } else {
                echo "<script>
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'ไม่สามารถทำรายการได้',
                    showConfirmButton: false,
                    timer: 2000
                });
                </script>";
            }

            // Close the statement
            mysqli_stmt_close($stmt);
            mysqli_stmt_close($stmt2);
        } else {
            // Prepare failed
            echo "<script>Swal.fire({
                icon: 'error',
                title: 'ไม่สามารถเตรียมคำสั่ง SQL ได้',
                footer: '<a href>Why do I have this issue?</a>'
            })</script>";
        }
    }
} else {
    echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'ไม่สามารถทำรายการได้ คุณไม่ใช่แอดมิน',
            showConfirmButton: false,
            timer: 2000 })
            </script>";
    header("Refresh:2; url=index.php");
}

?>

<body>
    <div class="container mt-5">
        <div class="row mt-2 justify-content-center align-items-center g-2">
            <?php
            while ($data = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col"></div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4>แก้ไขข้อมูลผู้ใช้งาน <?php echo $data['user_n'] ?> </h4>
                        </div>
                        <div class="card-body">

                            <form method="post">
                                <div class="mb-3">
                                    <label for="" class="form-label">อีเมลผู้ใช้งาน</label>
                                    <input type="email" class="form-control " id="email" name="email"
                                        value="<?php echo $data['email'] ?>" required>
                                    <label for="" class="form-label">รหัสผ่านใหม่ (ถ้าไม่ต้องการเปลี่ยน ไม่ต้องกรอก)</label>
                                    <input type="password" class="form-control " id="pass" name="pass">
                                    <label for="" class="form-label">ชื่อผู้ใช้งาน</label>
                                    <input type="text" class="form-control " id="user_n" name="user_n"
                                        value="<?php echo $data['user_n'] ?>" required>
                                </div>
                                <?php
            }
            ?>
                            <button type="submit" class="btn btn-color" style="width: 100%;">ยืนยัน</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>

    </div>
    <script>
        document.title = "แก้ไขผู้ใช้งาน";
    </script>

    <?php include('structure/footer.php') ?>
</body>
