<?php
session_start();
include 'db_connect.php';
if (!isset($_SESSION['username'])) { header('Location: index.php'); exit; }

$uid = (int)$_SESSION['user_id'];
$msg = "";

// Update profile (name/email) — if those columns exist you can adapt; this example uses username only
if (isset($_POST['update_profile'])) {
    $newUsername = trim($_POST['username']);
    mysqli_query($conn, "UPDATE users SET username='".mysqli_real_escape_string($conn,$newUsername)."' WHERE id=$uid");
    $_SESSION['username'] = $newUsername;
    $msg = "Profile updated.";
}

// Change password
if (isset($_POST['change_password'])) {
    $old = $_POST['old_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];
    // verify old password
    $res = mysqli_query($conn, "SELECT password FROM users WHERE id=$uid");
    $row = mysqli_fetch_assoc($res);
    if ($row && $row['password'] === $old) {              // plain-text compare: keeps compatibility
        if ($new === $confirm) {
            mysqli_query($conn, "UPDATE users SET password='".mysqli_real_escape_string($conn,$new)."' WHERE id=$uid");
            $msg = "Password changed successfully.";
        } else { $msg = "New password and confirm do not match."; }
    } else { $msg = "Old password is incorrect."; }
}

// Fetch current user info
$userRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$uid"));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>My Profile</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>.profile-box{background:#fff;padding:20px;border-radius:10px;max-width:600px;margin:30px auto;box-shadow:0 6px 18px rgba(0,0,0,0.06);} .profile-box input{width:100%;padding:10px;margin:8px 0} .msg{color:green}</style>
</head>
<body>
<div class="sidebar">
  <h2>E-Office</h2>
  <a href="dashboard.php">Dashboard</a>
  <a href="logout.php">Logout</a>
</div>

<div class="main-content">
  <div class="profile-box">
    <h2>My Profile</h2>
    <?php if($msg) echo "<p class='msg'>{$msg}</p>"; ?>
    <form method="post">
      <label>Username</label><br>
      <input type="text" name="username" value="<?php echo htmlspecialchars($userRow['username']); ?>" required><br>
      <button name="update_profile" type="submit">Update Profile</button>
    </form>

    <hr>

    <h3>Change Password</h3>
    <form method="post">
      <input type="password" name="old_password" placeholder="Old Password" required><br>
      <input type="password" name="new_password" placeholder="New Password" required><br>
      <input type="password" name="confirm_password" placeholder="Confirm New Password" required><br>
      <button name="change_password" type="submit">Change Password</button>
    </form>
  </div>
</div>
</body>
</html>
