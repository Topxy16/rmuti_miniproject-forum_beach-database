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
        $fd_datetime = date("Y-m-d H:i:s");

        $sql1 = "INSERT INTO forum (user_id, category_id) VALUES (?, ?)";
        $stmt1 = mysqli_prepare($conn, $sql1);

        if ($stmt1) {
            mysqli_stmt_bind_param($stmt1, 'ii', $user_id, $category_id);
            $result1 = mysqli_stmt_execute($stmt1);

            if ($result1) {
                $f_id = mysqli_insert_id($conn);
                
                $sql2 = "INSERT INTO forum_detail (fd_header, fd_content, fd_datetime, f_id) VALUES (?, ?, ?, ?)";
                $stmt2 = mysqli_prepare($conn, $sql2);

                if ($stmt2) {
                    mysqli_stmt_bind_param($stmt2, 'sssi', $fd_header, $fd_content, $fd_datetime, $f_id);
                    $result2 = mysqli_stmt_execute($stmt2);

                    if ($result2) {
                        if (@is_uploaded_file($_FILES['dspPic']['tmp_name'])) {
                            if (($_FILES['dspPic']['type'] == 'image/jpeg') || ($_FILES['dspPic']['type'] == 'image/png')) {
                                $target_dir = 'img/';
                                $target_file = $target_dir . basename($_FILES['dspPic']['name']);

                                if (move_uploaded_file($_FILES['dspPic']['tmp_name'], $target_file)) {
                                    $sql3 = "INSERT INTO `forum_image` (`fpic_id`, `fpic_image`, `user_id`, `f_id`) VALUES (NULL, ?, ?, ?);";
                                    $stmt3 = $conn->prepare($sql3);
                                    if ($stmt3) {
                                        $stmt3->bind_param("sii", $target_file, $user_id, $f_id);
                                        $result3 = mysqli_stmt_execute($stmt3);
                                        if ($result3) {
                              
                                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                                            echo "<script>
                                                    Swal.fire({
                                                    position: 'center',
                                                    icon: 'success',
                                                    title: 'ทำรายการสำเร็จ',
                                                    showConfirmButton: false,
                                                    timer: 2000
                                                    }).then(function() {
                                                        window.location.href = 'index.php';
                                                    });
                                                  </script>";
                                            ob_end_flush();
                                            exit;
                                        }
                                    } else {
                                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
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
                        } else {

                            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                            echo "<script>
                                    Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'ทำรายการสำเร็จ',
                                    showConfirmButton: false,
                                    timer: 2000
                                    }).then(function() {
                                        window.location.href = 'index.php';
                                    });
                                  </script>";
                            ob_end_flush();
                            exit;
                        }
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
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'กรุณาล็อกอิน',
            showConfirmButton: false,
            timer: 2000
            }).then(function() {
                window.location.href = 'login.php';
            });
          </script>";
}

$sql3 = "SELECT * FROM category";
$result3 = mysqli_query($conn, $sql3);

?>

<body>
    <div class="container mt-5">
        <div class="row g-2">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h4>โพสต์ฟอรัม</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="" class="form-label">หัวข้อ</label>
                                <input type="text" class="form-control " id="fd_header" name="fd_header"
                                    placeholder="กรอก หัวข้อ" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">รายละเอียด</label>
                                <textarea class="form-control" id="mytextarea" name="fd_content"
                                    ></textarea>
                            </div>
                            <label for="" class="form-label">ประเภทฟอรัมของคุณ</label>
                            <select class="form-select mb-3" aria-label="Default select example" name="category_id"
                                required>
                                <?php
                                while ($data = mysqli_fetch_assoc($result3)) {
                                    ?>
                                    <option value="<?php echo $data['category_id'] ?>">
                                        <?php echo $data['category_n'] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                            <button type="submit" class="btn btn-color" style="width: 100%;">ยืนยัน</button>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>รูป JPG/PNG</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <img id="previewImage" class="card-img-top" src="img/pre.jpg"
                                style="max-width: 100%; height: auto;">
                            <input class="form-control mt-2" type="file" id="dspPic" name="dspPic" accept="image/*">
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Selecting file input and image element
        const dspPicInput = document.getElementById('dspPic');
        const previewImage = document.getElementById('previewImage');

        // Set a default placeholder image
        const defaultImage = "https://via.placeholder.com/150"; // Default image URL

        // Adding an event listener for file input changes
        dspPicInput.addEventListener('change', function (event) {
            const file = event.target.files[0]; // Get the file from input
            if (file) {
                const reader = new FileReader(); // Create a FileReader object
                reader.onload = function (e) {
                    previewImage.src = e.target.result; // Set the image source to the loaded file
                }
                reader.readAsDataURL(file); // Read the file as a DataURL (base64)
            } else {
                // If no file is selected, reset to default image
                previewImage.src = defaultImage;
            }
        });

        // Reset the image preview to default if the form is reset
        document.querySelector('form').addEventListener('reset', function () {
            previewImage.src = defaultImage; // Reset to default image when form is reset
        });
    </script>
    <script>
        document.title = "สร้างฟอรัม";
    </script>
    <?php include('structure/footer.php') ?>