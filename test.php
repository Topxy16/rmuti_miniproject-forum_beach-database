<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Add your stylesheets and scripts here -->
</head>
<body>
    <?php include("navbar.php"); ?>

    <!-- Search Form -->
    <div class="container mt-3">
        <form action="search.php" method="GET" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="ค้นหา" aria-label="Search" name="query">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">ค้นหา</button>
        </form>
    </div>
