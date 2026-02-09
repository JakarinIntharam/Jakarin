<?php
if (isset($_POST['Submit'])) {
    // 1. ตรวจสอบว่าเชื่อมต่อฐานข้อมูลสำเร็จหรือไม่
    if (!$conn) {
        echo "<script>
            Swal.fire({
                icon: 'question',
                title: 'การเชื่อมต่อล้มเหลว',
                text: 'ไม่สามารถติดต่อฐานข้อมูลได้ กรุณาตรวจสอบไฟล์ connectdb.php'
            });
        </script>";
    } else {
        $sql = "SELECT a_id, a_name, a_password FROM admin WHERE a_username = ?";
        
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $_POST['auser']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if ($row = mysqli_fetch_assoc($result)) {
                // 2. ตรวจสอบรหัสผ่าน
                if (password_verify($_POST['apwd'], $row['a_password'])) {
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
                    // กรณีรหัสผ่านไม่ตรงกับใน DB
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'รหัสผ่านผิด!',
                            text: 'รหัสผ่านที่คุณระบุไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง'
                        });
                    </script>";
                }
            } else {
                // กรณีไม่พบ Username นี้ในระบบ
                echo "<script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'ไม่พบผู้ใช้งาน',
                        text: 'ชื่อผู้ใช้ \"" . htmlspecialchars($_POST['auser']) . "\" ไม่มีอยู่ในระบบ'
                    });
                </script>";
            }
            mysqli_stmt_close($stmt);
        } else {
            // กรณี Query มีปัญหา (เช่น ชื่อตารางหรือ Column ผิด)
            $db_error = mysqli_error($conn);
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'ระบบขัดข้อง (SQL Error)',
                    text: '" . addslashes($db_error) . "'
                });
            </script>";
        }
    }
}
?>