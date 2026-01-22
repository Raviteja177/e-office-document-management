<?php
session_start();
if($_SESSION['role'] != 'employee'){
    header("Location: admin_dashboard.php");
    exit;
}
?>

<h1>Employee Dashboard</h1>
<p>Welcome Employee: <?php echo $_SESSION['username']; ?></p>

<a href="upload.php">Upload Files</a>
<a href="my_files.php">My Documents</a>
<a href="logout.php">Logout</a>
