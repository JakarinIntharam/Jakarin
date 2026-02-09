<?php
    session_start();
    // แก้ชื่อไฟล์ให้ตรงเป๊ะๆ ตามรูปที่คุณส่งมา (connectDB.php)
    include_once("connectDB.php"); 

    $msg_script = ""; 

    if (isset($_POST['Submit'])) {
        
        // 1. เช็คว่ามีตัวแปร $conn จากไฟล์ connectDB.php หรือไม่
        if (!isset($conn) || !$conn) {
            $msg_script = "Swal.fire({
                icon: 'error',
                title: 'เชื่อมต่อฐานข้อมูลไม่ได้',
                text: 'ไม่พบตัวแปร \$conn หรือชื่อไฟล์ connectDB.php ไม่ตรง'
            });";
        } else {
            $user = $_POST['auser'];
            $pass = $_POST['apwd'];

            // 2. ใช้ $conn ตามในไฟล์ connectDB.php ของคุณ
            $sql = "SELECT a_id, a_name, a_password FROM admin WHERE a_username = ?";
            
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $user);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                if ($row = mysqli_fetch_assoc($result)) {
                    // 3. ตรวจสอบรหัสผ่าน
                    // ถ้าใน Database เก็บเป็นรหัสธรรมดา (ไม่ได้ Hash) ให้เปลี่ยนบรรทัดนี้เป็น: if ($pass == $row['a_password']) {
                    if (password_verify($pass, $row['a_password'])) {
                        
                        $_SESSION['a_id'] = $row['a_id'];
                        $_SESSION['a_name'] = $row['a_name'];
                        
                        $msg_script = "Swal.fire({
                            icon: 'success',
                            title: 'เข้าสู่ระบบสำเร็จ',
                            text: 'ยินดีต้อนรับคุณ " . $row['a_name'] . "',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location='index2.php';
                        });";
                        
                    } else {
                        $msg_script = "Swal.fire({
                            icon: 'error',
                            title: 'รหัสผ่านผิด',
                            text: 'กรุณาลองใหม่อีกครั้ง'
                        });";
                    }
                } else {
                    $msg_script = "Swal.fire({
                        icon: 'warning',
                        title: 'ไม่พบผู้ใช้',
                        text: 'ไม่พบ Username นี้ในระบบ'
                    });";
                }
                mysqli_stmt_close($stmt);
            } else {
                $msg_script = "Swal.fire({
                    icon: 'error',
                    title: 'SQL Error',
                    text: '" . addslashes(mysqli_error($conn)) . "'
                });";
            }
        }
    }
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
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            border: none;
        }
        .btn-login {
            background-color: #764ba2;
            border: none;
            padding: 12px;
            transition: 0.3s;
        }
        .btn-login:hover { background-color: #5a367f; }
    </style>
</head>
<body>

    <div class="card login-card">
        <div class="card-body p-5">
            <h3 class="text-center mb-4 fw-bold text-secondary">Admin Login</h3>
            <p class="text-center text-muted mb-4">ระบบหลังบ้าน : จักริน อินทราราม(ก้อง)</p>

            <form method="post" action="">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name="auser" placeholder="Username" required autofocus>
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
    <script>
        <?php echo $msg_script; ?>
    </script>
</body>
</html>