<?php

include("db.connect.php");
include("structure/header.php");
include("structure/navbar.php");

if (isset($_POST['category_n'])) {
    $catename = $_POST['category_n'];

    $sql = 'INSERT INTO `category` (`category_id`, `category_n`) VALUES (NULL, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $catename); // "ss" สำหรับสอง string
    $stmt->execute();
    if ($stmt) {
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
}
?>

<body>
    <div class="contrainer" style="margin-top: 200px;">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col"></div>
            <div class="col-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h2 class="mb-5 mt-3" style="text-align: center;">เพิ่มประเภทฟอรัม</h2>
                        </div>
                        <form method="post">
                            <div class="mb-3">

                                <input type="text" class="form-control " id="category_n" name="category_n" aria-describedby="emailHelp" placeholder="ชื่อประเภท" required>
                            </div>


                            <button type="submit" class="btn btn-color mb-3" style="width: 100%;">ยืนยัน</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <script>
        document.title = "เพิ่มประเภท";
    </script>
    <?php include('structure/footer.php') ?>