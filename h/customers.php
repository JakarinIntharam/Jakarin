<?php
   include_once("check_login.php");
   ?>


<body>
<h1>หน้าจัดการลูกค้า - Dashboard</h1>
<?php
    echo $_SESSION['a_name'];
?>

<ul>
    <a href="index2.php"><li>หน้าหลักแอดมิน</li></a>
    <a href="products.php"><li>จัดการสินค้า</li></a>
    <a href="orders.php"><li>จัดกาออเดอร์</li></a>
    <a href="customers.php"><li>จัดการลูกค้า</li></a>
    <a href="logout.php"><li>ออกจากระบบ</li></a>
</ul>

<?php

?>
</body>
</html>