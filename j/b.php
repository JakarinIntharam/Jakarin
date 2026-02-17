<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>จักริน อินทราราม (ก้อง)</title>
</head>

<body>
    <h1>งาน i</h1>
    <h1>จักริน อินทราราม (ก้อง)</h1>

    <form method="post" action="" enctype="multipart/form-data">
        ชื่อจังหวัด: <input type="text" name="pname" required autofocus><br><br>
    
        เลือกภาค: 
        <select name="rid">
            <?php
                include_once("connectDB.php");
                $sql3 = "SELECT * FROM `regions` ORDER BY `r_name` ASC";
                $rs3 = mysqli_query($conn, $sql3);
                while($data3 = mysqli_fetch_array($rs3)) {
            ?> 
                <option value="<?php echo $data3['r_id']; ?>"><?php echo $data3['r_name']; ?></option>
            <?php } ?> 
        </select><br><br>

        เลือกรูปภาพ: <input type="file" name="pimage" accept="image/*" required><br><br>
    
        <button type="submit" name="Submit"> บันทึก </button>
    </form>

<?php
    if(isset($_POST['Submit'])){
        include_once("connectDB.php");
        
        $pname = $_POST['pname'];
        $rid = $_POST['rid'];
        
        // หาขามสกุลไฟล์
        $ext = pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION);
        
        // 1. แก้ไข SQL Insert: เรียงตัวแปรให้ตรงกับชื่อฟิลด์ (เอา $rid มาก่อน $ext)
        $sql_insert = "INSERT INTO `provinces` (p_id, p_name, r_id, p_ext) VALUES (NULL, '$pname', '$rid', '$ext')";
        
        // 2. รันคำสั่ง SQL ก่อน! ถึงจะรู้ว่า ID ล่าสุดคืออะไร
        if(mysqli_query($conn, $sql_insert)){
            
            // 3. เมื่อบันทึกสำเร็จ ค่อยดึง ID ล่าสุดมาตั้งชื่อไฟล์
            $last_id = mysqli_insert_id($conn);
            $file_name = $last_id . "." . $ext;
            
            // 4. ทำการย้ายไฟล์ (Copy)
            copy($_FILES['pimage']['tmp_name'], "images/" . $file_name);
            
            echo "<script>alert('เพิ่มข้อมูลสำเร็จ'); window.location.href=window.location.href;</script>";
        } else {
            echo "Insert ไม่ได้: " . mysqli_error($conn);
        }
    }
?>

<br><hr><br>

<table border="1" cellpadding="5">
    <tr>
        <th>รหัสจังหวัด</th> 
        <th>ชื่อจังหวัด</th> 
        <th>รูปภาพ</th> 
        <th>ภาค</th>
    </tr>
<?php
    // ส่วนแสดงผล
    $sql = "SELECT * FROM `provinces` AS p 
            INNER JOIN `regions` AS r ON p.r_id = r.r_id
            ORDER BY p.p_id ASC";
    $rs = mysqli_query($conn , $sql); 

    while($data = mysqli_fetch_array($rs)){
?>
    <tr>
        <td><?php echo $data['p_id'];?></td>
        <td><?php echo $data['p_name'];?></td>
        <td>
            <img src="images/<?php echo $data['p_id']; ?>.<?php echo $data['p_ext']; ?>" width="100">
        </td>
        <td><?php echo $data['r_name'];?></td>
    </tr>
<?php } ?> 

</table>

</body>
</html>