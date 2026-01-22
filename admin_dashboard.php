<?php
session_start();
if($_SESSION['role'] != 'admin'){
    header("Location: employee_dashboard.php");
    exit;
}
?>

<h1>Admin Dashboard</h1>
<p>Welcome Admin: <?php echo $_SESSION['username']; ?></p>

<a href="view_docs.php">View All Documents</a>
<a href="upload.php">Upload Files</a>
<a href="manage_users.php">Manage Users</a>
<a href="logout.php">Logout</a>
