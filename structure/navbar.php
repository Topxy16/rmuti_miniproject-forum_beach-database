<nav class="navbar navbar-expand-lg sticky-top custom-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php">forumBeach</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <form class="d-flex" action="search_forum.php" method="GET">
                <input class="form-control me-2" type="search" placeholder="ค้นหาฟอรัม" aria-label="Search" name="query" required>
                <button class="btn btn-color" type="submit">ค้นหา</button>
            </form>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav ms-auto align-items-center">
                <li class="nav-ico">
                    <a class="ico" href="createforum.php" aria-label="Create Forum">
                        <i class="bi bi-pencil-square" style="color:white;"></i>
                    </a>
                    <a style="color:white; text-decoration: none;" href="createforum.php"><span>เพิ่มฟอรัม</span></a>
                </li>
                <?php if (@$_SESSION['role'] == '2') { ?>
                    <li class="nav-ico">
                        <a class="ico" href="dashboard_admin.php" aria-label="Admin Dashboard">
                            <i class="bi bi-clipboard-data" style="color:white;"></i>
                        </a>
                        <a style="color:white; text-decoration: none;" href="dashboard_admin.php"><span>แดชบอร์ด</span></a>
                    </li>
                <?php } ?>
                <?php if (@$_SESSION['user_id'] == '') { ?>
                    <li class="nav-ico">
                        <a class="ico" href="login.php" aria-label="Login">
                            <i class="bi bi-box-arrow-left" style="color:white;"></i>
                        </a>
                        <a style="color:white; text-decoration: none;" href="login.php"><span>ล็อกอิน</span></a>
                    </li>
                <?php } else { ?>
                    <li class="nav-ico">
                        <a class="ico" href="profile.php" aria-label="Profile">
                            <i class="bi bi-person-circle" style="color:white;"></i>
                        </a>
                        <a style="color:white; text-decoration: none;" href="profile.php"><span>โปรไฟล์</span></a>
                    </li>
                    <li class="nav-ico">
                        <a class="ico" href="logout.php" aria-label="Logout">
                            <i class="bi bi-box-arrow-right" style="color:white;"></i>
                        </a>
                        <a style="color:white; text-decoration: none;" href="logout.php"><span>ล็อกเอ้าท์</span></a>
                    </li>
                <?php } ?>
            </ul>
           
              
        </div>
    </div>
</nav>
