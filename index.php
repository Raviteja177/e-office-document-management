<?php
session_start();
include "db_connect.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>E-Office Login</title>

    <style>
        body {
            background: #e9eff5;
            font-family: Arial;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            width: 360px;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0,0,0,0.15);
            text-align: center;
        }
        .login-box h2 {
            margin-bottom: 20px;
            color: #007bff;
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 10px;
            border-radius: 6px;
            border: 1px solid #aaa;
        }
        button {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 95%;
        }
        button:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>

</head>
<body>

<div class="login-box">
    <h2>E-Office Login</h2>

    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Enter Username" required><br>
        <input type="password" name="password" placeholder="Enter Password" required><br>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
