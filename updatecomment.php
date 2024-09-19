<?php

include("db.connect.php");
include("navbar.php");

$fid = $_GET['f_id'];

$sql = 'SELECT `forum`.*, `forum_detail`.*, `profile`.* 
FROM `forum` 
INNER JOIN `forum_detail` ON `forum_detail`.`f_id` = `forum`.`f_id` 
INNER JOIN `profile` ON `forum`.`user_id` = `profile`.`user_id` WHERE forum.f_id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $fid);
$stmt->execute();
$result = $stmt->get_result();



$sql1 = 'SELECT `forum`.*, `comment`.*
FROM `forum` 
LEFT JOIN `comment` ON `comment`.`f_id` = `forum`.`f_id`
WHERE forum.f_id = ?';
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param('i', $fid);
$stmt1->execute();
$result1 = $stmt1->get_result();

$sql3 = 'SELECT `comment`.*, `user`.*
FROM `comment` 
	LEFT JOIN `user` ON `comment`.`user_id` = `user`.`user_id` 
    WHERE user.user_id = ?';
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param('i', $_SESSION['user_id']);
$stmt3->execute();
$result3 = $stmt3->get_result();


if (isset($_POST['ment_detail'])) {
    $userid = $_SESSION['user_id'];
    $mentdetail = $_POST['ment_detail'];
    $mentid = $_GET['ment_id'];

    $sql2 = 'UPDATE `comment` SET `ment_detail` = ? WHERE `comment`.`ment_id` = ?';
    $stmt2 = $conn->prepare($sql2);
    if ($stmt2) {
        $stmt2->bind_param('si', $mentdetail, $mentid);
        $result2 = mysqli_stmt_execute($stmt2);
        if ($result2) {
            echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'ทำรายการสำเร็จ',
            showConfirmButton: false,
            timer: 2000 })
            </script>";
            header("Refresh:2; url=forum.php?f_id=".$_GET['f_id'] );

            exit();
        } else {
            echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'ทำรายการไม่สำเร็จ',
            showConfirmButton: false,
            timer: 2000 })
            </script>";
            header("Refresh:2;");
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>

    </title>
    
    <link href="css/styles.css" rel=" stylesheet">
    <style>
        .avatar {

            width: 70px;
            height: 70px;
            border-radius: 50%;

            border-width: 1px;
            border-style: solid;
            border-color: black;

            margin-top: 15px;
            margin-bottom: auto;
            margin-left: 15px;
            margin-right: auto;
        }
    </style>
</head>

<body>


    <!-- ส่วนคอลั่ม ข้อมูล -->
    <div class="container">



        <?php
        while ($data = mysqli_fetch_assoc($result)) {
        ?>
            <div class="row mt-2 justify-content-center align-items-center g-2">
                <div class="col"></div>
                <div class="col-10">
                    <div class="card border-dark mb-3">
                        <div class="row g-0">
                            <div class="col-1 d-flex">
                                <img src="img/qa.png" alt="Avatar" class="avatar">
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $data['fd_header'] ?></h5>
                                    <p class="card-text"><?php echo $data['fd_content'] ?></p>
                                    <!-- เส้นใต้จาง -->
                                    <div class="underline"></div>
                                    <!-- เพิ่มส่วนแสดงสถานะ -->
                                    <div class="align-items-center">
                                        <div class="vr"></div>
                                        <span class="card-text"><small class="text-body-secondary"><?php echo $data['fd_datetime'] ?></small></span>
                                        <span class="card-text"><small class="text-body-secondary">ผู้โพสต์ <?php echo $data['user_n'] ?></small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
            </div>
            <?php while ($data = mysqli_fetch_assoc($result1)) { ?>
                <div class="row justify-content-center align-items-center g-2 mt-2">
                    <div class="col"></div>
                    <div class="col-10">
                        <div class="card border-dark">
                            <div class="card-body">
                                <?php if (@$_GET['ment_id'] == @$data['ment_id']) { ?>
                                    <form method="post">

                                        <div class="mb-3">                            
                                           <textarea name="ment_detail" id="ment_detail" cols="100" rows="5"> <?php echo $data['ment_detail']?></textarea>                                    
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">แก้ไขความเห็น</button>
                                    </form>
                                <?php } else { ?>
                                    <p class="card-text"><?php echo $data['ment_detail'] ?></p>
                                    <small class="text-body-secondary"> โพสต์เมื่อ : <?php echo $data['ment_datetime'] ?> | ความเห็นจากสามาชิกหมายเลข : <?php echo $data['user_id'] ?> </small>

                                    <?php if (@$_SESSION['user_id'] == @$data['user_id']) { ?>
                                        <div style="text-align: right">
                                            <a href="updatecomment.php?ment_id=<?php echo $data['ment_id'] ?>&f_id=<?php echo $_GET['f_id'] ?>" style="text-decoration: none; color:black;"><i class="bi bi-pencil"></i></a>
                                            <a href="updatecomment.php?ment_id=<?php echo $data['ment_id'] ?>" style="text-decoration: none; color:black;"><i class="bi bi-trash"></i></a>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col"></div>
                </div>
            <?php } ?>
            

        <?php
        }
        ?>
    </div>
    <!-- ส่วนคอลั่ม ข้อมูล -->

</body>

</html>