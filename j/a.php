<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>จักริน อินทราราม (ก้อง)</title>
</head>

<body>
    <h1>งาน i</h1>
    <h1>จักริน อินทราราม (ก้อง)</h1>

    <form method="post" action="">
        ชื่อภาค <input type="text" name="rname" autofocus required>
        <button type="Submit" name="Submit"> บันทึก </button>
    </form>
    <br>
    <br>

<?php
    // ย้าย connectDB มาไว้ข้างบนสุด หรือเรียกใช้เมื่อจำเป็น
    include_once("connectDB.php");

    if(isset($_POST['Submit'])){
        $rname = $_POST['rname'];
        // แนะนำ: ควรป้องกัน SQL Injection แต่โค้ดนี้ใช้เรียนรู้เบื้องต้นได้ครับ
        $sql2 = "INSERT INTO `regions` VALUES (NULL, '$rname')";
        mysqli_query($conn, $sql2) or die ("insert ไม่ได้: " . mysqli_error($conn));
    }
?>

<table border="1">
    <tr>
        <th>รหัสภาค</th>
        <th>ชื่อภาค</th>
        <th>ลบ</th>
    </tr>
<?php
    $sql = "SELECT * FROM `regions` ORDER BY `r_id` ASC";
    $rs = mysqli_query($conn, $sql); 

    while($data = mysqli_fetch_array($rs)){
?>
    <tr>
        <td><?php echo $data['r_id'];?></td>
        <td><?php echo $data['r_name'];?></td>
        
        <td width="50" align="center">
            <a href="delete_region.php?id=<?php echo $data['r_id'];?>" onclick="return confirm('ยืนยันการลบ?');">
                <img src="images/del.png" width="20" alt="ลบ">
            </a>
        </td>
    </tr>
<?php 
    } // ปิด loop while
?> 
</table>

</body>
</html>