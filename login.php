<?php
		include('navbar.php');
        include('db.connect.php');
        
        if(isset($_POST['email'])){
			$email = $_POST['email'];
			$pass = $_POST['pass'];
			
			$sql = 'SELECT * FROM user WHERE email = "'.$email.'"';
			$res = mysqli_query($conn, $sql);
			$data = mysqli_fetch_assoc($res);
			
			if($email==$data['email']&&$pass==$data['pass']){
			$_SESSION['user_id']=$data['user_id'];
            print_r($_SESSION);
			header('location:index.php');
				
			}else{
                echo "<script>
            Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'ไม่สามารถทำรายการได้',
            showConfirmButton: false,
            timer: 2000 })
            </script>";
            header("Refresh:2; url=login.php");
            }
			
		}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    
    <div class="contrainer mt-5">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col"></div>
            <div class="col-3">
                <div class="card border-dark">
                    <div class="card-body">
                        <div class="card-title">
                            <h2>เข้าสู่ระบบ</h2>
                        </div>
                        <form method="post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">อีเมล</label>
                                <input type="email" class="form-control " id="email" name="email" aria-describedby="emailHelp" placeholder="กรอก อีเมล" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">รหัสผ่าน</label>
                                <input type="password" class="form-control" id="pass" name="pass" placeholder="กรอก รหัสผ่าน" required>
                            </div>
                            <button type="submit" class="btn btn-success" style="width: 100%;">ยืนยัน</button>
                           
                        </form>
                        <a href="register.php" class="btn btn-primary w-100 mt-2" role="button" data-bs-toggle="button">สมัคสมาชิก</a>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>

</html>