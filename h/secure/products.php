<?php
    include_once("check_login.php");
    include_once("connectdb.php"); // อย่าลืม include ไฟล์เชื่อมต่อฐานข้อมูล
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จัดการสินค้า (Products)</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background: radial-gradient(circle at 10% 20%, rgb(34, 34, 56) 0%, rgb(18, 18, 30) 90%);
            min-height: 100vh;
            color: #fff;
        }

        /* ใช้ Style เดียวกับ Dashboard */
        .glass-nav {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
        }

        /* ปรับแต่งตารางให้เข้ากับธีมมืด */
        .table-glass {
            color: #e0e0e0;
            vertical-align: middle;
        }
        .table-glass thead th {
            background-color: rgba(0, 0, 0, 0.2);
            color: #00d2ff; /* สีฟ้านีออนสำหรับหัวตาราง */
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            font-weight: 600;
        }
        .table-glass td, .table-glass th {
            border-color: rgba(255, 255, 255, 0.05);
        }
        .table-glass tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        /* รูปสินค้า */
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.2);
        }

        /* ปุ่ม Action */
        .btn-action {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: 0.3s;
        }
        .btn-edit { background: rgba(255, 193, 7, 0.2); color: #ffc107; }
        .btn-edit:hover { background: #ffc107; color: #000; }
        
        .btn-delete { background: rgba(255, 50, 50, 0.2); color: #ff6b6b; }
        .btn-delete:hover { background: #ff6b6b; color: #fff; }

        .btn-neon {
            background: linear-gradient(45deg, #00d2ff, #3a7bd5);
            border: none;
            color: white;
            box-shadow: 0 0 10px rgba(0, 210, 255, 0.3);
        }
        .btn-neon:hover {
            box-shadow: 0 0 20px rgba(0, 210, 255, 0.6);
            color: white;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg glass-nav mb-4 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="index2.php">
                <i class="bi bi-cpu-fill"></i> SYSTEM<span style="color:#00d2ff">ADMIN</span>
            </a>
            <div class="d-flex align-items-center">
                <span class="text-white-50 me-3 d-none d-md-block">Login: <?php echo $_SESSION['a_name']; ?></span>
                <a class="btn btn-outline-light btn-sm rounded-pill px-3" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="index2.php" class="text-decoration-none text-white-50 mb-2 d-inline-block">
                    <i class="bi bi-arrow-left"></i> กลับหน้า Dashboard
                </a>
                <h2 class="fw-bold text-white">จัดการสินค้า (Products)</h2>
            </div>
            <a href="form_product.php" class="btn btn-neon rounded-pill px-4">
                <i class="bi bi-plus-lg"></i> เพิ่มสินค้าใหม่
            </a>
        </div>

        <div class="glass-card">
            <div class="table-responsive">
                <table class="table table-glass text-center">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="15%">รูปภาพ</th>
                            <th width="35%" class="text-start">ชื่อสินค้า</th>
                            <th width="15%">ราคา</th>
                            <th width="15%">คงเหลือ</th>
                            <th width="15%">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        // ตัวอย่างการดึงข้อมูลจาก DB (แก้ SQL ให้ตรงกับตารางของคุณ)
                        // $sql = "SELECT * FROM product ORDER BY p_id DESC";
                        // $result = mysqli_query($conn, $sql);
                        // while($data = mysqli_fetch_array($result)) {
                        ?>

                        <tr>
                            <td>1</td>
                            <td>
                                <img src="images/sample-product.jpg" class="product-img" alt="Product" 
                                     onerror="this.src='https://via.placeholder.com/60?text=No+Img'"> 
                            </td>
                            <td class="text-start">
                                <div class="fw-bold text-white">โน้ตบุ๊กเกมมิ่ง XYZ</div>
                                <small class="text-muted">ID: P001 | หมวดหมู่: IT</small>
                            </td>
                            <td class="text-info fw-bold">25,900 ฿</td>
                            <td><span class="badge bg-success bg-opacity-75">15 ชิ้น</span></td>
                            <td>
                                <a href="form_update_product.php?id=1" class="btn-action btn-edit me-1" title="แก้ไข">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="delete_product.php?id=1" class="btn-action btn-delete" title="ลบ" onclick="return confirm('ยืนยันการลบข้อมูล?');">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                        
                        <?php 
                        // } // ปีกกาปิด Loop while
                        ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>