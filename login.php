<?php
session_start();
include "db_connect.php";

$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($check) === 1) {
        $data = mysqli_fetch_assoc($check);
        $_SESSION['username'] = $data['username'];
        $_SESSION['user_id'] = $data['id'];
        header("Location: dashboard.php");
        exit;
    } else {
        $msg = "Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>E-Office Login</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="center-screen">

<div class="login-box">
    <h2>E-Office Login</h2>
    <?php if($msg) echo "<p class='error'>$msg</p>"; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
