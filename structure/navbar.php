<nav class="navbar navbar-expand-lg sticky-top custom-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php">forumBeach</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-ico">
                    <a class="ico" href="createforum.php"><i class="bi bi-pencil-square" style="color:white;"></i></a>
                    <a style="color:white; text-decoration: none;" href="createforum.php"><span>ฟอรัม</span></a>
                </li>
                <?php
                if (@$_SESSION['role'] == '2') {
                ?>
                    <li class="nav-ico">
                        <a class="ico" href="dashboard_admin.php"><i class="bi bi-clipboard-data" style="color:white;"></i></a>
                        <a style="color:white; text-decoration: none;" href="dashboard_admin.php"><span>แดชบอร์ด</span></a>
                    </li>
                <?php } ?>
                <?php
                if (@$_SESSION['user_id'] == '') {
                ?>
                    <li class="nav-ico">
                        <a class="ico" href="login.php"><i class="bi bi-box-arrow-left" style="color:white;"></i></a>
                        <a style="color:white; text-decoration: none;" href="login.php"><span>ล็อกอิน</span></a>
                    </li>
                <?php } else { ?>
                    <li class="nav-ico">
                        <a class="ico" href="profile.php"><i class="bi bi-person-circle" style="color:white;"></i></a>
                        <a style="color:white; text-decoration: none;" href="profile.php"><span>โปรไฟล์</span></a>
                    </li>
                    <li class="nav-ico">
                        <a class="ico" href="logout.php"><i class="bi bi-box-arrow-right" style="color:white;"></i></a>
                        <a style="color:white; text-decoration: none;" href="logout.php"><span>ล็อกเอ้าท์</span></a>
                    </li>
                   
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>