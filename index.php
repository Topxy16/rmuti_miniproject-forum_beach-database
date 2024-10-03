<?php

include("db.connect.php");
include("structure/header.php");
include("structure/navbar.php");


$sql = 'SELECT forum.*, category.*, forum_detail.*, profile.user_n
        FROM forum 
        LEFT JOIN category ON forum.category_id = category.category_id 
        LEFT JOIN forum_detail ON forum_detail.f_id = forum.f_id
        LEFT JOIN profile ON forum.user_id = profile.user_id
        ORDER BY forum_detail.fd_datetime DESC';
$result = mysqli_query($conn, $sql);

$sql3 = 'SELECT forum.*, category.*, forum_detail.*, profile.user_n
         FROM forum 
         LEFT JOIN category ON forum.category_id = category.category_id 
         LEFT JOIN forum_detail ON forum_detail.f_id = forum.f_id 
         LEFT JOIN profile ON forum.user_id = profile.user_id
         ORDER BY forum_detail.fd_datetime DESC';
$result3 = mysqli_query($conn, $sql3);

$sql4 = 'SELECT COUNT(*) AS count_m, f_id
FROM comment
GROUP BY f_id;';
$result4 = mysqli_query($conn, $sql4);

$sql5 = 'SELECT COUNT(*) AS count_m, f_id
FROM comment
GROUP BY f_id
ORDER BY count_m DESC;';
$result5 = mysqli_query($conn, $sql5);

$sql6 = 'SELECT forum.*, category.*, forum_detail.*, profile.user_n
         FROM forum 
         LEFT JOIN category ON forum.category_id = category.category_id 
         LEFT JOIN forum_detail ON forum_detail.f_id = forum.f_id 
         LEFT JOIN profile ON forum.user_id = profile.user_id';
$result6 = mysqli_query($conn, $sql6);

$sql7 = 'SELECT * FROM category;';
$result7 = mysqli_query($conn, $sql7);

if (!empty(@$_SESSION['user_id'])) {
    $sql1 = 'SELECT * FROM profile WHERE user_id =' . $_SESSION['user_id'];
    $result1 = mysqli_query($conn, $sql1);

    $sql2 = 'SELECT `forum`.*, `comment`.*
FROM `forum` 
LEFT JOIN `comment` ON `comment`.`f_id` = `forum`.`f_id`
WHERE comment.f_id = 10;';
    $result2 = mysqli_query($conn, $sql2);
    $countment = mysqli_num_rows($result2);
}

?>

<body>
    <div class="hero">
        <div class="container">
            <div class="row mb-2">
                <div class="col-9">
                    <div class="card mb-2" style="margin-top: 50px">
                        <div class="card-header">
                            <h5>เพิ่มเข้ามาล่าสุด</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            $count = 0;
                            while ($data = mysqli_fetch_assoc($result3)) {
                                if ($count >= 3) {
                                    break;
                                }
                            ?>
                                <a href="forum.php?f_id=<?php echo $data["f_id"] ?>">
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <h5 class="fheader"><?php echo $data['fd_header'] ?></h5>
                                                <div class="badge wrap-color text-wrap mb-3">
                                                    <?php echo $data['category_n'] ?>
                                                </div>
                                                <div>
                                                    <small>ผู้โพสต์ <?php echo $data['user_n'] ?> |
                                                        <?php echo $data['fd_datetime'] ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <hr>
                            <?php
                                $count++;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-header">
                            <h5>เป็นที่นิยม</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            $count = 0;
                            while ($data = mysqli_fetch_assoc($result5)) {
                                while ($data2 = mysqli_fetch_assoc($result6)) {
                                    if ($count >= 3) {
                                        break;
                                    }
                                    if (@$data['f_id'] == @$data2['f_id']) {
                            ?>
                                        <a href="forum.php?f_id=<?php echo $data2["f_id"] ?>">
                                            <div class="row">
                                                <div class="col">
                                                    <div>
                                                        <div class="header">
                                                            <h5 class="fheader"><?php echo $data2['fd_header'] ?></h5>
                                                        </div>
                                                        <div class="badge wrap-color text-wrap mb-3">
                                                            <?php echo $data2['category_n'] ?>
                                                        </div>
                                                        <div>
                                                            <small>ผู้โพสต์ <?php echo $data2['user_n'] ?> |
                                                                <?php echo $data2['fd_datetime'] ?></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col d-flex align-items-end justify-content-end">
                                                    <div>
                                                        <?php if (@$data['f_id'] == @$data2['f_id']) { ?>
                                                            <i class="bi bi-chat"></i> <?php echo $data['count_m']; ?>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <hr>
                            <?php
                                        $count++;
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5>ทั้งหมด</h5>
                        </div>
                        <div class="card-body">
                            <?php while ($dataall = mysqli_fetch_assoc($result)) { ?>
                                <a href="forum.php?f_id=<?php echo $dataall['f_id'] ?>">
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <h5 class="fheader"><?php echo $dataall['fd_header'] ?></h5>
                                                <div class="badge wrap-color text-wrap mb-3">
                                                    <?php echo $dataall['category_n'] ?>
                                                </div>
                                                <div>
                                                    <small>ผู้โพสต์ <?php echo $dataall['user_n'] ?> |
                                                        <?php echo $dataall['fd_datetime'] ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <?php while ($countm = mysqli_fetch_assoc($result4)) {  ?>
                                            <div class="col d-flex align-items-end justify-content-end">
                                                <div>
                                                    <?php if (@$dataall['f_id'] == @$countm['f_id']) { ?>
                                                        <i class="bi bi-chat"> </i> <?php echo $countm['count_m']; ?>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php } ?>
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
                    <div class="sticky">
                        <?php
                        if (!empty(@$_SESSION['user_id'])) {
                            while ($data = mysqli_fetch_assoc($result1)) {
                        ?>
                                <div class="card testimonial-card">
                                    <div class="card-header">
                                        <h5>สมาชิกหมายเลข : <?php echo $_SESSION['user_id'] ?></h5>
                                    </div>
                                    <div class="card-up" style="background-color: #6d5b98;"></div>
                                    <div class="avatar mx-auto ">
                                        <a href="imageprofile.php">
                                            <img src="<?php echo ($data['image'] != "" ? $data['image'] : 'img/prepro.jpg'); ?>"
                                                class="rounded-circle img-fluid" />
                                        </a>
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
                        } else { ?>
                            <div class="card testimonial-card">
                                <div class="card-header">
                                    <h5>สมาชิกหมายเลข : </h5>
                                </div>
                                <div class="card-up" style="background-color: #6d5b98;"></div>
                                <div class="avatar mx-auto ">
                                    <a href="login.php">
                                        <img src="img/prepro.jpg"
                                            class="rounded-circle img-fluid" />
                                    </a>
                                </div>
                                <div class="card-body text-center">
                                    <h4 class="mb-4"></h4>
                                    <hr />
                                    <p class="dark-grey-text mt-4">
                                        <a href="login.php">
                                            <h3>กรุณาเข้าสู่ระบบ</h3>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="card testimonial-card mt-2">
                            <div class="card-header text-center">
                                <h5>ประเภทฟอรัม</h5>
                            </div>
                            <div class="card-body text-center">
                                <?php while ($data = mysqli_fetch_assoc($result7)) { ?>
                                    <div>
                                        <a href="index_cate.php?query=<?php echo $data['category_n'] ?>">
                                            <?php echo $data['category_n'] ?>
                                        </a>
                                    </div>
                                    <hr>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="card testimonial-card mt-2">
                            <div class="card-header text-center">
                                เกี่ยวกับเรา
                            </div>
                            <div class="card-body">
                                <div><a href="https://www.facebook.com/wachirawit.chuenchitt">ติดต่อทีมงาน forumBeach</a></div>
                                <div><a href="https://www.facebook.com/profile.php?id=100017823878759">ร่วมงานกับ forumBeach</a></div>
                                <div><a href="https://www.facebook.com/profile.php?id=100004898866275">ติดต่อลงโฆษณา</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="createforum.php" class="btn btn-color sticky-btn">
        <i class="bi bi-plus"></i> สร้างฟอรัม
    </a>

    <script>
        document.title = "forum Beach";
    </script>
    <?php include('structure/footer.php') ?>