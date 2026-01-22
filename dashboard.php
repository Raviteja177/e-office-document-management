<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit();
}

include "db_connect.php";

// Fetch counts
$task_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tasks");
$task = mysqli_fetch_assoc($task_q)['total'];

$doc_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM documents");
$docs = mysqli_fetch_assoc($doc_q)['total'];

$user_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
$users = mysqli_fetch_assoc($user_q)['total'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>E-Office Dashboard</title>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Chart.js CDN (working) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial;
            background: #f2f4f7;
            margin: 0;
            padding: 0;
        }
        .header {
            background: #007bff;
            padding: 15px;
            color: white;
            font-size: 22px;
            text-align: center;
        }
        .container {
            width: 90%;
            margin: auto;
            padding-top: 25px;
        }
        .cards {
            display: flex;
            gap: 20px;
        }
        .card {
            flex: 1;
            padding: 20px;
            background: white;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .card h2 {
            color: #007bff;
            font-size: 40px;
        }
        .menu {
            margin-top: 30px;
        }
        .menu a {
            display: inline-block;
            margin: 10px;
            padding: 12px 18px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        .menu a:hover {
            background: #0056b3;
        }
        .chart-box {
            margin-top: 40px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
    </style>

</head>
<body>

<!-- DEBUG OUTPUT FOR CHECKING DATA (added here) -->
<?php 
echo "<script>
console.log('Tasks: $task'); 
console.log('Docs: $docs'); 
console.log('Users: $users');
</script>";
?>

<div class="header">
    Welcome, <?php echo $_SESSION['username']; ?> 👋 — E-Office Dashboard
</div>

<div class="container">

    <!-- Stats Cards -->
    <div class="cards">
        <div class="card">
            <h2><?php echo $task; ?></h2>
            <p>Total Tasks</p>
        </div>

        <div class="card">
            <h2><?php echo $docs; ?></h2>
            <p>Total Documents</p>
        </div>

        <div class="card">
            <h2><?php echo $users; ?></h2>
            <p>Total Users</p>
        </div>
    </div>

    <!-- Menu Buttons -->
    <div class="menu">
        <a href="upload.php">📄 Upload Documents</a>
        <a href="view_docs.php">📁 View Documents</a>
        <a href="add_employee.php">👤 Add Employee</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

    <!-- Chart -->
    <div class="chart-box">
        <canvas id="myChart" height="120"></canvas>
    </div>
</div>

<!-- Pass PHP values to JS -->
<script>
    var taskCount = <?php echo $task; ?>;
    var docCount = <?php echo $docs; ?>;
    var userCount = <?php echo $users; ?>;
</script>

<script src="assets/js/dashboard.js"></script>

</body>
</html>
