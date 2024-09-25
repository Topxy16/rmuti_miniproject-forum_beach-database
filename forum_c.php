<?php

include("db.connect.php");
include("structure/header.php");
include("structure/navbar.php");


$sql = 'SELECT `forum`.*, `category`.*, `forum_detail`.*
FROM `forum` 
	LEFT JOIN `category` ON `forum`.`category_id` = `category`.`category_id` 
	LEFT JOIN `forum_detail` ON `forum_detail`.`f_id` = `forum`.`f_id`
    WHERE category.category_id = 4;';
$result = mysqli_query($conn,  $sql);

$sql4 = 'SELECT COUNT(*) AS count_m, f_id
FROM comment
GROUP BY f_id;';
$result4 = mysqli_query($conn,  $sql4);


if (!empty($_SESSION)) {
    $sql1 = 'SELECT * FROM profile WHERE user_id =' . $_SESSION['user_id'];
    $result1 = mysqli_query($conn,  $sql1);

    $sql2 = 'SELECT `forum`.*, `comment`.*
FROM `forum` 
LEFT JOIN `comment` ON `comment`.`f_id` = `forum`.`f_id`
WHERE comment.f_id = 10;';
    $result2 = mysqli_query($conn,  $sql2);
    $countment = mysqli_num_rows($result2);
}



?>

<body>
    <div class="hero">
        <div class="wrapper">
            <?php include("structure/sidebar.php"); ?>
            <div class="container" style="margin-top: 50px">
                <div class="row mb-2">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h5>คำถาม</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                while ($data = mysqli_fetch_assoc($result)) {
                                ?>
                                    <a href="forum.php?f_id=<?php echo $data["f_id"] ?>">
                                        <div class="row">
                                            <div class="col">
                                                <div>
                                                    <h5><?php echo $data['fd_header'] ?></h5>
                                                    <div class="badge wrap-color text-wrap mb-3">
                                                        <?php echo $data['category_n'] ?>
                                                    </div>
                                                    <div>
                                                        <small>สมาชิกหมายเลข <?php echo $data['user_id'] ?> | <?php echo $data['fd_datetime'] ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $data1 = mysqli_fetch_assoc($result4) ?>
                                            <div class="col d-flex align-items-end justify-content-end">
                                                <div>
                                                    <?php if (@$data['f_id'] == @$data1['f_id']) { ?>
                                                        <i class="bi bi-chat"> <?php echo $data1['count_m']; ?></i>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                        </div>
                                    </a>
                                    <hr>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <?php
                        if (!empty($_SESSION)) {
                            while ($data = mysqli_fetch_assoc($result1)) {
                        ?>
                                <div class="card testimonial-card">
                                    <div class="card-header">
                                        <h5>สมาชิกหมายเลข : <?php echo $_SESSION['user_id'] ?></h5>
                                    </div>
                                    <div class="card-up" style="background-color: #6d5b98;"></div>
                                    <div class="avatar mx-auto ">
                                        <img src="<?php echo ($data['image'] != "" ? $data['image'] : 'img/prepro.jpg'); ?>" class="rounded-circle img-fluid" />
                                    </div>
                                    <div class="card-body text-center">
                                        <h4 class="mb-4"><?php echo $data['user_n'] ?></h4>
                                        <hr />
                                        <p class="dark-grey-text mt-4">
                                            สถานะ : <?php echo ($_SESSION['role'] == 2 ? "แอดมิน" : "ผู้ใช้งานทั่วไป") ?>
                                        </p>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                        <div class="card testimonial-card mt-2">
                            <div class="card-header text-center">
                                <h5>ประเภทฟอรัม</h5>
                            </div>
                            <div class="card-body text-center">
                                <div><a href="forum_q.php">คำถาม</a></div>
                                <hr>
                                <div><a href="forum_c.php">สนทนา</a></div>
                                <hr>
                                <div><a href="forum_s.php">ขายของ</a></div>
                                <hr>
                                <div><a href="forum_n.php">ข่าว</a></div>
                            </div>
                        </div>
                        <div class="card testimonial-card mt-2">
                            <div class="card-header text-center">
                                เกี่ยวกับเรา
                            </div>
                            <div class="card-body">
                                <div><a href="">ติดต่อทีมงาน forumBeach</a></div>
                                <div><a href="">ร่วมงานกับ forumBeach</a></div>
                                <div><a href="">ติดต่อลงโฆษณา</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.title = "หน้าแรก";
    </script>
    <?php include('structure/footer.php') ?>