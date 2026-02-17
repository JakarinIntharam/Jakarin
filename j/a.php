<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>จักริน อินทราราม (ก้อง)</title>
</head>

<body>
    <h1>งาน i</h1>
    <h1>จักริน อินทราราม (ก้อง)</h1>
<form method = "post" action="">
    ชื่อภาค <input type= "text" name="rname" autofocus required>
    <button type ="Submit" name = "Submit"> บันทึก </button>
</FROM>
<br>
<br>

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
        <th>ชื่อภาค</th> </tr>
<?php
    include_once("connectDB.php");
    $sql = "SELECT * FROM `regions` ORDER BY `r_id` ASC";
    $rs = mysqli_query($conn , $sql); 

    while($data = mysqli_fetch_array($rs)){
?>
    <tr>
        <td><?php echo $data['r_id'];?></td>
        <td><?php echo $data['r_name'];?></td>
    </tr>
<?php } // เพิ่มช่องว่างตรงนี้แล้วครับ ?> 


</table>

</body>
</html>