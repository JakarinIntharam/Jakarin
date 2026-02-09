<?php
    include_once("check_login.php");
    include_once("connectdb.php");
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จัดการออเดอร์ (Orders)</title>
    
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

        /* Navbar Style */
        .glass-nav {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Card Style */
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
        }

        /* Table Style */
        .table-glass {
            color: #e0e0e0;
            vertical-align: middle;
            margin-bottom: 0;
        }
        .table-glass thead th {
            background-color: rgba(0, 0, 0, 0.2);
            color: #00d2ff;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            font-weight: 600;
        }
        .table-glass td, .table-glass th {
            border-color: rgba(255, 255, 255, 0.05);
            padding: 15px 10px;
        }
        .table-glass tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        /* Status Badges (ป้ายสถานะแบบเรืองแสง) */
        .badge-status {
            padding: 8px 12px;
            border-radius: 30px;
            font-weight: 400;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        .status-paid { background: rgba(25, 135, 84, 0.2); color: #20c997; border: 1px solid rgba(32, 201, 151, 0.3); }
        .status-pending { background: rgba(255, 193, 7, 0.2); color: #ffc107; border: 1px solid rgba(255, 193, 7, 0.3); }
        .status-cancel { background: rgba(220, 53, 69, 0.2); color: #ff6b6b; border: 1px solid rgba(255, 107, 107, 0.3); }

        /* Action Buttons */
        .btn-action {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: 0.3s;
            text-decoration: none;
        }
        .btn-view { background: rgba(13, 110, 253, 0.2); color: #6ea8fe; }
        .btn-view:hover { background: #0d6efd; color: #fff; box-shadow: 0 0 10px rgba(13, 110, 253, 0.5); }
        
        .btn-update { background: rgba(32, 201, 151, 0.2); color: #20c997; }
        .btn-update:hover { background: #20c997; color: #fff; box-shadow: 0 0 10px rgba(32, 201, 151, 0.5); }

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
                <h2 class="fw-bold text-white">จัดการออเดอร์ (Orders)</h2>
            </div>
            <button class="btn btn-outline-info rounded-pill px-4">
                <i class="bi bi-printer"></i> รายงานสรุป
            </button>
        </div>

        <div class="glass-card">
            <div class="table-responsive">
                <table class="table table-glass text-center">
                    <thead>
                        <tr>
                            <th width="10%">Order ID</th>
                            <th width="25%" class="text-start">ลูกค้า</th>
                            <th width="15%">ยอดรวม</th>
                            <th width="20%">วันที่สั่งซื้อ</th>
                            <th width="15%">สถานะ</th>
                            <th width="15%">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        // ตัวอย่าง SQL (แก้ให้ตรงกับ DB ของคุณ)
                        // $sql = "SELECT * FROM orders ORDER BY o_id DESC";
                        // $result = mysqli_query($conn, $sql);
                        // while($row = mysqli_fetch_array($result)) {
                        ?>

                        <tr>
                            <td>#ORD-001</td>
                            <td class="text-start">
                                <div class="fw-bold text-white">สมชาย ใจดี</div>
                                <small class="text-muted">081-234-5678</small>
                            </td>
                            <td class="text-info fw-bold">1,590 ฿</td>
                            <td class="text-white-50">25/10/2023 10:30</td>
                            <td>
                                <span class="badge-status status-paid">
                                    <i class="bi bi-check-circle-fill me-1"></i> ชำระเงินแล้ว
                                </span>
                            </td>
                            <td>
                                <a href="order_detail.php?id=1" class="btn-action btn-view me-1" title="ดูรายละเอียด">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="update_order.php?id=1" class="btn-action btn-update" title="อัปเดตสถานะ">
                                    <i class="bi bi-truck"></i>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>#ORD-002</td>
                            <td class="text-start">
                                <div class="fw-bold text-white">สมหญิง จริงใจ</div>
                                <small class="text-muted">089-987-6543</small>
                            </td>
                            <td class="text-info fw-bold">590 ฿</td>
                            <td class="text-white-50">25/10/2023 11:15</td>
                            <td>
                                <span class="badge-status status-pending">
                                    <i class="bi bi-hourglass-split me-1"></i> รอชำระเงิน
                                </span>
                            </td>
                            <td>
                                <a href="order_detail.php?id=2" class="btn-action btn-view me-1" title="ดูรายละเอียด">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="update_order.php?id=2" class="btn-action btn-update" title="อัปเดตสถานะ">
                                    <i class="bi bi-truck"></i>
                                </a>
                            </td>
                        </tr>

                         <tr>
                            <td>#ORD-003</td>
                            <td class="text-start">
                                <div class="fw-bold text-white">Guest User</div>
                                <small class="text-muted">-</small>
                            </td>
                            <td class="text-info fw-bold">3,200 ฿</td>
                            <td class="text-white-50">24/10/2023 18:00</td>
                            <td>
                                <span class="badge-status status-cancel">
                                    <i class="bi bi-x-circle-fill me-1"></i> ยกเลิก
                                </span>
                            </td>
                            <td>
                                <a href="order_detail.php?id=3" class="btn-action btn-view me-1" title="ดูรายละเอียด">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                            </td>
                        </tr>

                        <?php
                        // } // ปิด loop
                        ?>

                    </tbody>
                </table>
            </div>
            
            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link bg-transparent text-white-50" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link bg-transparent text-white border-primary" href="#">1</a></li>
                    <li class="page-item"><a class="page-link bg-transparent text-white-50" href="#">2</a></li>
                    <li class="page-item"><a class="page-link bg-transparent text-white-50" href="#">Next</a></li>
                </ul>
            </nav>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>