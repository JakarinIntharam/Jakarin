<?php
    session_start();
    include_once("connectdb.php"); 
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login: จักริน อินทราราม(ก้อง)</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Sarabun', sans-serif;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .btn-login {
            background-color: #764ba2;
            border: none;
            padding: 12px;
            font-size: 1.1rem;
            transition: 0.3s;
        }
        .btn-login:hover {
            background-color: #5a367f;
        }
    </style>
</head>

<body>

    <div class="card login-card">
        <div class="card-body p-5">
            <h3 class="text-center mb-4 fw-bold text-secondary">Admin Login</h3>
            <p class="text-center text-muted mb-4">ระบบหลังบ้าน : จักริน อินทราราม(ก้อง)</p>

            <form method="post" action="">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name="auser" placeholder="Username" autofocus required>
                    <label for="floatingInput"><i class="bi bi-person-fill"></i> Username</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="floatingPassword" name="apwd" placeholder="Password" required>
                    <label for="floatingPassword"><i class="bi bi-lock-fill"></i> Password</label>
                </div>

                <div class="d-grid">
                    <button type="submit" name="Submit" class="btn btn-primary btn-login text-white rounded-pill">
                        เข้าสู่ระบบ
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    if (isset($_POST['Submit'])) {
        // 1. ตรวจสอบการเชื่อมต่อฐานข้อมูล
        if (!$conn) {
            echo "<script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Database Error',
                    text: 'ไม่สามารถเชื่อมต่อฐานข้อมูลได้ กรุณาตรวจสอบไฟล์ connectdb.php'
                });
            </script>";
        } else {
            $user = $_POST['auser'];
            $pass = $_POST['apwd'];

            $sql = "SELECT a_id, a_name, a_password FROM admin WHERE a_username = ?";
            
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $user);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                if ($row = mysqli_fetch_assoc($result)) {
                    // 2. ตรวจสอบรหัสผ่าน (ใช้ password_verify สำหรับรหัสที่ผ่านการ Hash)
                    if (password_verify($pass, $row['a_password'])) {
                        
                        $_SESSION['a_id'] = $row['a_id'];
                        $_SESSION['a_name'] = $row['a_name'];
                        
                        echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'เข้าสู่ระบบสำเร็จ',
                                text: 'ยินดีต้อนรับคุณ " . $row['a_name'] . "',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location='index2.php';
                            });
                        </script>";
                        
                    } else {
                        // กรณีรหัสผ่านไม่ถูกต้อง
                        echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'เข้าสู่ระบบไม่ได้',
                                text: 'รหัสผ่าน (Password) ไม่ถูกต้อง!'
                            });
                        </script>";
                    }
                    
                } else {
                    // กรณีไม่ชื่อผู้ใช้นี้ในระบบ
                    echo "<script>
                        Swal.fire({
                            icon: 'warning',
                            title: 'ไม่พบผู้ใช้งาน',
                            text: 'ชื่อผู้ใช้ (Username) นี้ไม่มีอยู่ในระบบ'
                        });
                    </script>";
                }
                mysqli_stmt_close($stmt);
            } else {
                // กรณีคำสั่ง SQL ผิดพลาด
                $error_msg = mysqli_error($conn);
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'SQL Error',
                        text: '" . addslashes($error_msg) . "'
                    });
                </script>";
            }
        }
    }
    ?>
</body>
</html>