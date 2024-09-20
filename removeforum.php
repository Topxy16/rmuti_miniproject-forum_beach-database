<?php
include("db.connect.php");
include("structure/header.php");
include("structure/navbar.php");

$sql = 'DELETE FROM forum WHERE f_id  = ' . $_GET['f_id'];
$result = mysqli_query($conn, $sql);

if ($_SESSION['role'] == '2') {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'ทำรายการสำเร็จ',
            showConfirmButton: false,
            timer: 2000 })
            </script>";
    header("Refresh:2; url=forum_admin.php");    
} else {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'ทำรายการสำเร็จ',
            showConfirmButton: false,
            timer: 2000 })
            </script>";
    header("Refresh:2; url=profile.php");
}
?>
