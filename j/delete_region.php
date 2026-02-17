<meta charset="utf-8">

<?php
    // 1. รับค่า id ที่ส่งมาจาก Link (หน้า a.php ส่งมาแบบ GET)
    // เช็คว่ามีการส่ง id มาหรือไม่
    if(isset($_GET['id'])){
        
        include_once("connectDB.php");
        
        // รับค่าตัวแปร id
        $id = $_GET['id'];

        // 2. แก้คำสั่ง SQL
        // - เปลี่ยน FORM เป็น FROM
        // - ชื่อตารางต้องตรงกับในฐานข้อมูล (น่าจะชื่อ regions มี s)
        $sql = "DELETE FROM `regions` WHERE r_id = '$id'";

        // 3. สั่งรันคำสั่ง SQL (ใช้ตัวแปร $sql ที่เป็นคำสั่งลบ)
        mysqli_query($conn, $sql) or die ("ลบไม่ได้: " . mysqli_error($conn));
        
        // 4. แก้ไข JavaScript สำหรับเด้งกลับหน้าเดิม
        echo "<script>";
        echo "window.location='a.php';"; // อย่าลืม semicolon (;)
        echo "</script>";
    } else {
        // ถ้าไม่มี id ส่งมา ให้เด้งกลับไปเลย
        echo "<script>window.location='a.php';</script>";
    }
?>