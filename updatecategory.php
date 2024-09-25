<?php

include("db.connect.php");
include("structure/header.php");
include("structure/navbar.php");


$sql = 'SELECT * FROM category WHERE category_id = ' . $_GET['category_id'];
$result = mysqli_query($conn, query: $sql);

if (!empty($_POST)) {
    $cateid = $_GET['category_id'];
    $catename = $_POST['category_n'];

    $sql2 = 'UPDATE category SET category_n = ? WHERE category_id = ?';
    $stmt = mysqli_prepare($conn, $sql2);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'si', $catename, $cateid);
        $result2 = mysqli_stmt_execute($stmt);

        if ($result2) {
            echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'ทำรายการสำเร็จ',
            showConfirmButton: false,
            timer: 2000 })
            </script>";
            header("Refresh:2; url=category_admin.php");
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

        mysqli_stmt_close($stmt);
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
}


?>

<body>
    <div class="container" style="margin-top: 200px;">
        <div class="row mt-2 justify-content-center align-items-center g-2">
            <?php
            while ($data = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col"></div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header" style="text-align:center;">
                            <h2>แก้ไขประเภท</h2>
                        </div>
                        <div class="card-body mt-3">
                            <form method="post">
                                <div class="mb-3">                              
                                    <label for="" class="form-label">ชื่อผู้ใช้งาน</label>
                                    <input type="text" class="form-control " id="category_n" name="category_n" value="<?php echo $data['category_n'] ?>" required>
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
        document.title = "แก้ไขประเภท";
    </script>

    <?php include('structure/footer.php') ?>