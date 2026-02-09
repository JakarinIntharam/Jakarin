<?php
    session_start();
    
    // ตรวจสอบว่ามี Session a_id หรือไม่
    if(empty($_SESSION['a_id'])){
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Access Denied</title>
    
    <meta http-equiv="refresh" content="3; url=index.php">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background: radial-gradient(circle at 10% 20%, rgb(34, 34, 56) 0%, rgb(18, 18, 30) 90%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            overflow: hidden;
        }

        .glass-alert {
            background: rgba(255, 50, 50, 0.1); /* พื้นหลังสีแดงจางๆ */
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 50, 50, 0.3);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 0 30px rgba(255, 0, 0, 0.2);
            max-width: 450px;
            width: 90%;
            animation: popIn 0.5s ease;
        }

        .icon-lock {
            font-size: 5rem;
            color: #ff6b6b;
            margin-bottom: 20px;
            text-shadow: 0 0 20px rgba(255, 107, 107, 0.6);
        }

        .btn-back {
            background: #ff6b6b;
            border: none;
            color: white;
            padding: 10px 30px;
            border-radius: 50px;
            margin-top: 20px;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-back:hover {
            background: #ff4757;
            box-shadow: 0 0 15px rgba(255, 71, 87, 0.6);
            color: white;
        }

        /* Loading Spinner */
        .spinner-border {
            width: 1.5rem;
            height: 1.5rem;
            margin-right: 10px;
        }

        @keyframes popIn {
            0% { transform: scale(0.8); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body>

    <div class="glass-alert">
        <i class="bi bi-shield-lock-fill icon-lock"></i>
        <h2 class="fw-bold text-white">Access Denied!</h2>
        <p class="text-white-50 mt-3">
            คุณไม่มีสิทธิ์เข้าถึงหน้านี้ หรือยังไม่ได้เข้าสู่ระบบ<br>
            ระบบกำลังพาท่านไปหน้า Login...
        </p>
        
        <div class="mt-4 text-white-50">
            <div class="spinner-border text-danger" role="status"></div>
            <small>รอสักครู่...</small>
        </div>

        <a href="index.php" class="btn-back mt-4">ไปหน้า Login ทันที</a>
    </div>

</body>
</html>
<?php
        exit; // สำคัญมาก: ต้องมี exit เพื่อหยุดการทำงานของโค้ดส่วนล่างในไฟล์ที่ include ไป
    }
?>