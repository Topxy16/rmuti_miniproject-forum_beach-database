<?php

include("db.connect.php");
include("structure/header.php");
include("structure/navbar.php");

$sql = 'SELECT * FROM forum_detail';
$result = mysqli_query($conn, query: $sql);

?>

<body>
    <div class="hero">
        <div class="container">
            <h2 class="mt-2">ฟอรัม</h2>
            <?php
            while ($data = mysqli_fetch_assoc($result)) {
            ?>
                <div class="row mt-2 justify-content-center align-items-center g-2">
                    <div class="col"></div>
                    <div class="col-10">
                        <a href="forum.php?f_id=<?php echo $data["f_id"] ?>" style="text-decoration: none;">
                            <div class="card border-dark mb-3">
                                <div class="row g-0">
                                    <div class="col-1 d-flex">
                                        <img src="img/qa.png" alt="avatar" class="avatar">
                                    </div>
                                    <div class="col">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $data['fd_header'] ?></h5>
                                            <p class="card-text"><?php echo $data['fd_content'] ?></p>
                                            <div class="underline"></div>
                                            <div class="align-items-center">
                                                <div class="vr"></div>
                                                <span class="card-text"><small class="text-body-secondary"><?php echo $data['fd_datetime'] ?></small></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col"></div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <?php include('structure/footer.php') ?>