<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="css/navbar.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400&display=swap" rel="stylesheet">

</head>

<body class="custom-body">
    <nav class="navbar navbar-expand-lg sticky-top custom-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">forum beach</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link mx-2" href=""><i class="bi bi-archive"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="createforum.php"><i class="bi bi-pencil-square"></i></a>
                    </li>
                    <?php
                    if (@$_SESSION['user_id'] == '') {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link mx-2" href="login.php"><i class="bi bi-box-arrow-left"></i></i></a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link mx-2" href="logout.php"><i class="bi bi-box-arrow-right"></i></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-2" href="profile.php"><i class="bi bi-person-circle"></i></i></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>







</body>

</html>