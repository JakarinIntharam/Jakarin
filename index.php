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

    <style>
        body {
            /* พื้นหลังแบบไล่เฉดสี */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Sarabun', sans-serif; /* แนะนำให้หา Google Font ภาษาไทยมาใส่เพิ่ม */
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

    <?php
    if(isset($_POST['Submit'])){
        
        $sql = "SELECT a_id, a_name, a_password FROM admin WHERE a_username = ?";
        
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $_POST['auser']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if ($row = mysqli_fetch_assoc($result)) {
                
                // ตรวจสอบรหัสผ่าน (Hash)
                if (password_verify($_POST['apwd'], $row['a_password'])) {
                    
                    $_SESSION['a_id'] = $row['a_id'];
                    $_SESSION['a_name'] = $row['a_name'];
                    
                    // ใช้ SweetAlert2 แจ้งเตือนสวยๆ ก่อนเด้ง (ถ้าไม่ชอบลบออกใช้แบบเดิมได้)
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'เข้าสู่ระบบสำเร็จ',
                            text: 'กำลังพาท่านไปหน้าหลัก...',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location='index2.php';
                        });
                    </script>";
                    
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'ผิดพลาด',
                            text: 'รหัสผ่านไม่ถูกต้อง'
                        });
                    </script>";
                }
                
            } else {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่พบผู้ใช้',
                        text: 'ไม่พบชื่อผู้ใช้นี้ในระบบ'
                    });
                </script>";
            }
            
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>