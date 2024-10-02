<?php

include("db.connect.php");
include("structure/header.php");
include("structure/navbar.php");

if (@is_uploaded_file($_FILES['dspPic']['tmp_name'])) {
    $fid = $_GET['f_id'];
    if (($_FILES['dspPic']['type'] == 'image/jpeg') || ($_FILES['dspPic']['type'] == 'image/png') || ($_FILES['dspPic']['type'] == 'image/gif')) {
        $target_dir = 'img/';
        $target_file = $target_dir . basename($_FILES['dspPic']['name']);

        if (move_uploaded_file($_FILES['dspPic']['tmp_name'], $target_file)) {
            $sql = "UPDATE `forum_image` SET `fpic_image` = ? WHERE `f_id` = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("si", $target_file, $fid);
                $result = mysqli_stmt_execute($stmt);
                if ($result) {
                    echo "<script>
                            Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'ทำรายการสำเร็จ',
                            showConfirmButton: false,
                            timer: 2000 })
                            </script>";
                    header("Refresh:2; url=forum.php?f_id=" . $_GET['f_id']);
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
            $stmt->close();
        } else {
            echo "<script>
                Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'เกิดข้อผิดพลาดในการอัปโหลดไฟล์!',
                showConfirmButton: false,
                timer: 2000 })
                </script>";
        }
    } else {
        echo "<script>
        Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'ประเภทไฟล์ไม่ถูกต้อง! อนุญาตเฉพาะไฟล์ JPEG และ PNG เท่านั้น!',
        showConfirmButton: false,
        timer: 2000 })
        </script>";
    }
}


?>
<body>
    <div class="container" style="margin-top: 100px;">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col"></div>
            <div class="col">
                <div class="card">
                <div class="card-header" style="text-align:center;">
                            <h2>แก้ไขรูปฟอรัม</h2>
                        </div>
                    <div class="card-body">
                        <img id="previewImage" class="card-img-top" src="img/pre.jpg" style="max-width: 100%; height: auto;">
                        <div class="mb-3">
                            <form method="post" enctype="multipart/form-data">
                                <input class="form-control mt-2" type="file" id="dspPic" name="dspPic" accept="image/*">
                                <button type="submit" class="btn btn-color mt-2" style="width: 100%;">ยืนยัน</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>

  <!-- JavaScript for image preview -->
  <script>
        // Selecting file input and image element
        const dspPicInput = document.getElementById('dspPic');
        const previewImage = document.getElementById('previewImage');

        // Set a default placeholder image
        const defaultImage = "https://via.placeholder.com/150"; // Default image URL

        // Adding an event listener for file input changes
        dspPicInput.addEventListener('change', function(event) {
            const file = event.target.files[0]; // Get the file from input
            if (file) {
                const reader = new FileReader(); // Create a FileReader object
                reader.onload = function(e) {
                    previewImage.src = e.target.result; // Set the image source to the loaded file
                }
                reader.readAsDataURL(file); // Read the file as a DataURL (base64)
            } else {
                // If no file is selected, reset to default image
                previewImage.src = defaultImage;
            }
        });

        // Reset the image preview to default if the form is reset
        document.querySelector('form').addEventListener('reset', function() {
            previewImage.src = defaultImage; // Reset to default image when form is reset
        });
    </script>
       <script>
            document.title = "เพิ่มรูปโปร";
        </script>
    <?php include('structure/footer.php') ?>
