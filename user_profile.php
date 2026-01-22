<?php
session_start();
?>

<h2>User Profile</h2>

<p><b>Username:</b> <?php echo $_SESSION['username']; ?></p>
<p><b>Role:</b> <?php echo $_SESSION['role']; ?></p>

<a href="dashboard.php">Back</a>
