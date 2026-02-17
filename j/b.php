<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>จักริน อินทราราม (ก้อง)</title>
</head>

<body>
    <h1>งาน i</h1>
    <h1>จักริน อินทราราม (ก้อง)</h1>

    <form method="post" action="" enctype="multipart/form-data"> ชื่อจังหวัด: <input type="text" name="pname" required><br>
    
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
    </select><br>

    เลือกรูปภาพ: <input type="file" name="pimage" accept="image/*" required><br><br>
    
    <button type="submit" name="Submit"> บันทึก </button>
</form>

<?php
    if(isset($_POST['Submit'])){
        include_once("connectDB.php");
        $rname = $_POST['rname'];
        $sql2 = "INSERT INTO `regions` VALUES (NULL, '{$_POST['rname']}')";
        mysqli_query($conn,$sql2) or die ("insert ไม่ได้");
    }

?>

<table border= "1">
    <tr>
        <th>รหัสภาค</th>
        <th>ชื่อจังหวัด</th> 
        <th>รูปภาพ</th> 
        <th>ภาค</th>
    </tr>
<?php
    include_once("connectDB.php");
    $sql = "SELECT * FROM `provinces` AS p 
    Inner join `regions` AS r
    ON p.r_id = r.r_id
    ORDER BY p.p_id ASC";
    $rs = mysqli_query($conn , $sql); 

    while($data = mysqli_fetch_array($rs)){
?>
    <tr>
    <td><?php echo $data['p_id'];?></td>
    <td><?php echo $data['p_name'];?></td>
    <td><img src="images/<?php echo $data['p_id']; ?>.<?php echo $data['p_ext']; ?>" width="100"></td>
    <td><?php echo $data['r_name'];?></td>
</tr>
<?php }  ?> 


</table>

</body>
</html>