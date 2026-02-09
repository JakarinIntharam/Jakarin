<?php
    include_once("check_login.php");
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Prompt', sans-serif;
            /* พื้นหลังธีมมืด ไล่สี Deep Space */
            background: radial-gradient(circle at 10% 20%, rgb(34, 34, 56) 0%, rgb(18, 18, 30) 90%);
            min-height: 100vh;
            color: #fff;
        }

        /* Navbar สไตล์กระจก */
        .glass-nav {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        /* การ์ดเมนูสไตล์ Glassmorphism */
        .glass-card {
            background: rgba(255, 255, 255, 0.05); /* โปร่งใส */
            border-radius: 20px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2); /* เงาฟุ้ง */
            backdrop-filter: blur(8px); /* เบลอฉากหลัง */
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.1); /* ขอบบางๆ */
            transition: all 0.4s ease;
            height: 100%;
            overflow: hidden;
            position: relative;
        }

        /* เอฟเฟกต์ตอน Hover (ชี้แล้วเรืองแสง) */
        .glass-card:hover {
            transform: translateY(-10px) scale(1.02);
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 20px rgba(118, 75, 162, 0.6); /* แสงสีม่วง */
        }

        .card-icon-bg {
            font-size: 3.5rem;
            margin-bottom: 15px;
            /* ไล่สีตัวไอคอน */
            background: -webkit-linear-gradient(45deg, #00d2ff, #3a7bd5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* เปลี่ยนสีไอคอนตามแต่ละการ์ด */
        .icon-product { background: -webkit-linear-gradient(45deg, #FF512F, #DD2476); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .icon-order { background: -webkit-linear-gradient(45deg, #00b09b, #96c93d); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .icon-customer { background: -webkit-linear-gradient(45deg, #8E2DE2, #4A00E0); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .icon-logout { background: -webkit-linear-gradient(45deg, #cb2d3e, #ef473a); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        .card-title {
            font-weight: 600;
            letter-spacing: 1px;
            color: #fff;
        }
        
        .card-text {
            color: #aaa;
            font-size: 0.9rem;
        }

        /* ตกแต่งปุ่ม Logout บน Navbar */
        .btn-logout-nav {
            background: rgba(255, 50, 50, 0.2);
            border: 1px solid rgba(255, 50, 50, 0.4);
            color: #ff6b6b;
            transition: 0.3s;
        }
        .btn-logout-nav:hover {
            background: #ff6b6b;
            color: #fff;
            box-shadow: 0 0 15px rgba(255, 107, 107, 0.5);
        }
        
        /* วงกลมตกแต่งฉากหลัง (เพื่อความสวยงาม) */
        .bg-shape {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            animation: float 6s ease-in-out infinite;
        }
        .shape-1 { width: 300px; height: 300px; background: #764ba2; top: -50px; left: -50px; opacity: 0.4; }
        .shape-2 { width: 400px; height: 400px; background: #2a5298; bottom: -100px; right: -100px; opacity: 0.3; }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(20px); }
            100% { transform: translateY(0px); }
        }

    </style>
</head>

<body>

    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>

    <nav class="navbar navbar-expand-lg glass-nav mb-5 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="index2.php">
                <i class="bi bi-cpu-fill"></i> SYSTEM<span style="color:#00d2ff">ADMIN</span>
            </a>
            
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item me-4 text-white-50">
                        <small>Logged in as</small> 
                        <span class="text-white fw-bold ms-1"><?php echo $_SESSION['a_name']; ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-logout-nav btn-sm rounded-pill px-4 py-2" href="logout.php">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h1 class="display-5 fw-bold text-white mb-2">Dashboard Control</h1>
                <p class="text-white-50">ยินดีต้อนรับเข้าสู่ระบบจัดการข้อมูลหลังบ้าน</p>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            
            <div class="col-md-6 col-lg-3">
                <a href="products.php" class="text-decoration-none">
                    <div class="glass-card text-center p-4">
                        <div class="card-icon-bg icon-product">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h5 class="card-title">จัดการสินค้า</h5>
                        <p class="card-text">Products Management</p>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="orders.php" class="text-decoration-none">
                    <div class="glass-card text-center p-4">
                        <div class="card-icon-bg icon-order">
                            <i class="bi bi-cart3"></i>
                        </div>
                        <h5 class="card-title">จัดการออเดอร์</h5>
                        <p class="card-text">Orders & Payment</p>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <a href="customers.php" class="text-decoration-none">
                    <div class="glass-card text-center p-4">
                        <div class="card-icon-bg icon-customer">
                            <i class="bi bi-people"></i>
                        </div>
                        <h5 class="card-title">จัดการลูกค้า</h5>
                        <p class="card-text">Members Data</p>
                    </div>
                </a>
            </div>

             <div class="col-md-6 col-lg-3">
                <a href="logout.php" class="text-decoration-none" onclick="return confirm('ยืนยันการออกจากระบบ?');">
                    <div class="glass-card text-center p-4">
                        <div class="card-icon-bg icon-logout">
                            <i class="bi bi-power"></i>
                        </div>
                        <h5 class="card-title text-danger">ออกจากระบบ</h5>
                        <p class="card-text">Sign Out</p>
                    </div>
                </a>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>