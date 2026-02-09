<?php
    include_once("check_login.php");
    include_once("connectdb.php");
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จัดการลูกค้า (Customers)</title>
    
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

        /* Avatar รูปโปรไฟล์ */
        .avatar-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.2);
            margin-right: 15px;
        }

        /* Search Box Design */
        .search-glass {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            border-radius: 30px;
            padding: 8px 20px;
        }
        .search-glass::placeholder { color: rgba(255, 255, 255, 0.5); }
        .search-glass:focus {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            border-color: #00d2ff;
            box-shadow: 0 0 10px rgba(0, 210, 255, 0.3);
            outline: none;
        }

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
        .btn-edit { background: rgba(255, 193, 7, 0.2); color: #ffc107; }
        .btn-edit:hover { background: #ffc107; color: #000; box-shadow: 0 0 10px rgba(255, 193, 7, 0.5); }
        
        .btn-delete { background: rgba(255, 50, 50, 0.2); color: #ff6b6b; }
        .btn-delete:hover { background: #ff6b6b; color: #fff; box-shadow: 0 0 10px rgba(255, 50, 50, 0.5); }

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
        
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <a href="index2.php" class="text-decoration-none text-white-50 mb-2 d-inline-block">
                    <i class="bi bi-arrow-left"></i> กลับหน้า Dashboard
                </a>
                <h2 class="fw-bold text-white">จัดการลูกค้า (Customers)</h2>
            </div>
            
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <form action="" method="get" class="d-inline-flex">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control search-glass" placeholder="ค้นหาชื่อ หรือเบอร์โทร..." style="min-width: 250px;">
                        <button class="btn btn-primary rounded-pill ms-2 px-4" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="glass-card">
            <div class="table-responsive">
                <table class="table table-glass align-middle">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th width="35%">ข้อมูลสมาชิก</th>
                            <th width="30%">ช่องทางติดต่อ</th>
                            <th width="15%" class="text-center">วันที่สมัคร</th>
                            <th width="15%" class="text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        // ตัวอย่าง SQL
                        // $sql = "SELECT * FROM customers ORDER BY c_id DESC";
                        // $result = mysqli_query($conn, $sql);
                        // while($row = mysqli_fetch_array($result)) {
                        ?>

                        <tr>
                            <td class="text-center">1</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=Somchai+J&background=0D8ABC&color=fff" class="avatar-circle" alt="Avatar">
                                    <div>
                                        <div class="fw-bold text-white">คุณสมชาย ใจดี</div>
                                        <small class="text-muted">Username: somchai2023</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-info"><i class="bi bi-envelope me-2"></i>somchai@email.com</div>
                                <div class="text-white-50"><i class="bi bi-telephone me-2"></i>081-234-5678</div>
                            </td>
                            <td class="text-center text-white-50">01/01/2023</td>
                            <td class="text-center">
                                <a href="update_customer.php?id=1" class="btn-action btn-edit me-1" title="แก้ไขข้อมูล">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="delete_customer.php?id=1" class="btn-action btn-delete" title="ลบ/แบน" onclick="return confirm('ยืนยันการลบสมาชิกนี้?');">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center">2</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=Wannipa+K&background=DD2476&color=fff" class="avatar-circle" alt="Avatar">
                                    <div>
                                        <div class="fw-bold text-white">คุณวรรณิภา เก่งมาก</div>
                                        <small class="text-muted">Username: wanni_k</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-info"><i class="bi bi-envelope me-2"></i>wannipa@test.com</div>
                                <div class="text-white-50"><i class="bi bi-telephone me-2"></i>099-888-7777</div>
                            </td>
                            <td class="text-center text-white-50">15/05/2023</td>
                            <td class="text-center">
                                <a href="update_customer.php?id=2" class="btn-action btn-edit me-1" title="แก้ไขข้อมูล">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="delete_customer.php?id=2" class="btn-action btn-delete" title="ลบ/แบน" onclick="return confirm('ยืนยันการลบสมาชิกนี้?');">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>

                        <?php
                        // } // ปิด Loop
                        ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>