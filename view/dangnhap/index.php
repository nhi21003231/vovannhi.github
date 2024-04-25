<?php
session_start();

include_once("controller/ctlsanpham.php");
include_once("model/msanpham.php");

if (isset($_SESSION['username'])) {
    header("Location: admin.php");
    exit();
}

// Handling Login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $p = new csanpham();
    $result = $p->getdangnhap($username, $password);

    if ($result === -1) {
        // $error = "Không thể kết nối CSDL.";
        echo '<script>alert("Không thể kết nối CSDL.")</script>';
    } elseif ($result === 0) {
        // $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
        echo '<script>alert("Tên đăng nhập hoặc mật khẩu không đúng.")</script>';
    } else {
        $_SESSION['username'] = $username;
        header("Location: admin.php");
        exit();
    }
}

// Handling Registration
if (isset($_POST['register'])) {
    $username = $_POST['txtname'];
    $password = md5($_POST['txtpass']);
    $hodem = $_POST['txthodem'];
    $ten = $_POST['txtten'];
    $p = new msanpham();
    $r = $p->dangky($iduser,$username, $password, $hodem, $ten);

    if ($r === true) {
        // $registration_message = 'Đăng ký thành công';
        echo '<script>alert("Đăng ký thành công")</script>';
    } else {
        echo '<script>alert("Đăng ký không thành công.")</script>';
        // $registration_message = 'Đăng ký không thành công';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration</title>
</head>
<body>
    <?php if (isset($_GET['action']) && $_GET['action'] == 'register') : ?>
        <h2>Đăng ký</h2>
        <form method="POST" action="">
            <label for="txtname">Username:</label>
            <input type="text" id="txtname" name="txtname" required><br>
            <label for="txtpass">Password:</label>
            <input style="margin-left: 4px;" type="password" id="txtpass" name="txtpass" required><br>
            <label for="txthodem">Họ đệm:</label>
            <input style="margin-left: 14px;" type="text" id="txthodem" name="txthodem" required><br>
            <label for="txtten">Tên:</label>
            <input style="margin-left: 40px;" type="text" id="txtten" name="txtten" required><br>
            <input type="submit" name="register" value="Đăng ký">
        </form>
        <p><a href="?action=login">Đã có tài khoản?đăng nhập</a></p>
        <?php if ($registration_message !== '') { echo "<p>$registration_message</p>"; } ?>
    <?php else: ?>
        <h2>Đăng nhập</h2>
        <form method="POST" action="">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Mật khẩu:</label>
            <input style="margin-left: 35px;" type="password" id="password" name="password" required><br>
            <input type="submit" name="login" value="Đăng nhập">
        </form>
        <p><a href="?action=register">Chưa có tài khoản?Đăng ký</a></p>
        <?php if ($error !== '') { echo "<p>$error</p>"; } ?>
    <?php endif; ?>
</body>
</html>
