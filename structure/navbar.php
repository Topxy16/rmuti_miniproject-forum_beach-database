
<nav class="navbar navbar-expand-lg sticky-top custom-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php">forum beach</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto align-items-center">               
                <li class="nav-item">
                    <a class="nav-link mx-2" href="createforum.php"><i class="bi bi-pencil-square"></i></a>
                </li>
                <?php
                if (@$_SESSION['role'] == '2') {
                ?>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="dashboard_admin.php"><i class="bi bi-clipboard-data"></i></a>
                    </li>
                <?php } ?>
                <?php
                if (@$_SESSION['user_id'] == '') {
                ?>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="login.php"><i class="bi bi-box-arrow-left"></i></a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="profile.php"><i class="bi bi-person-circle"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="logout.php"><i class="bi bi-box-arrow-right"></i></a>
                    </li>
                 
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
