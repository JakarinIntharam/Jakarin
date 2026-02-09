<?php
    session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>จักริน อินทราราม(ก้อง)</title>
</head>

<body>
<h1>a.php</h1>

<?php
    $name = "จักริน อินทราราม";
    $nickname = "ก้อง";
    $_SESSION['name']="$name";
    $_SESSION['nickname']="$nickname";
    echo $_SESSION['name']."<br>";
    echo $_SESSION['nickname']."<br>";
?>
</body>
</html>
