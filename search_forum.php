<?php
include("db.connect.php");
include("structure/header.php");
include("structure/navbar.php");

if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($conn, $_GET['query']);

    // ค้นหาในหลายตาราง
    $sql = "
        SELECT forum.*, category.*, forum_detail.*, profile.*
        FROM forum 
        LEFT JOIN category ON forum.category_id = category.category_id 
        LEFT JOIN forum_detail ON forum_detail.f_id = forum.f_id
        LEFT JOIN profile ON profile.user_id = forum.user_id
        WHERE forum_detail.fd_header LIKE '%$query%' 
        OR forum_detail.fd_content LIKE '%$query%' 
        OR category.category_n LIKE '%$query%' 
        OR forum_detail.fd_header LIKE '%$query%' 
        OR forum_detail.fd_content LIKE '%$query%'
        OR profile.user_n LIKE '%$query%'
        
    ";
    
    $result = mysqli_query($conn, $sql);
?>

    <div class="container" style="margin-top: 50px">
        <h2>ผลลัพธ์การค้นหา: <?php echo htmlspecialchars($query); ?></h2>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['fd_header']); ?></h5>
                                <div class="badge wrap-color text-wrap mb-3">
                                    <?php echo $row['category_n'] ?>
                                </div>
                                <div>
                                    <small>ผู้โพสต์ <?php echo $row['user_n'] ?> |
                                        <?php echo $row['fd_datetime'] ?></small>
                                </div>
                            </div>
                            <div class="col d-flex align-items-end justify-content-end">
                                <div>
                                    <a href="forum.php?f_id=<?php echo $row['f_id']; ?>" class="btn btn-color">อ่านเพิ่มเติม</a>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
        <?php
            }
        } else {
            echo "<p>ไม่พบผลลัพธ์สำหรับการค้นหา: " . htmlspecialchars($query) . "</p>";
        }
        ?>
    </div>

    <script>
        document.title = "<?php echo $_GET['query'] ?>";
    </script>

<?php
} else {
    echo "<p>กรุณาใส่คำค้นหา</p>";
}

include('structure/footer.php');
?>