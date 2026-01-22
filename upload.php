<?php
include "db_connect.php";

$message = "";

if (isset($_POST['submit'])) {

    $fileName = $_FILES['document']['name'];
    $fileTmp = $_FILES['document']['tmp_name'];

    $uploadPath = "uploads/" . basename($fileName);

    if (move_uploaded_file($fileTmp, $uploadPath)) {
        mysqli_query($conn, "INSERT INTO documents (file_name) VALUES ('$fileName')");
        $message = "<p style='color:green; font-weight:bold;'>✔ Document Uploaded Successfully!</p>";
    } else {
        $message = "<p style='color:red; font-weight:bold;'>✖ Upload Failed. Try again.</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Documents</title>

    <style>
        body {
            margin: 0;
            font-family: Poppins, sans-serif;
            background: #f4f7fc;
        }
        .sidebar {
            width: 230px;
            height: 100vh;
            background: #1f3c88;
            color: white;
            position: fixed;
            padding-top: 20px;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 25px;
        }
        .sidebar a {
            display: block;
            padding: 15px;
            text-decoration: none;
            color: white;
            font-size: 16px;
        }
        .sidebar a:hover {
            background: #162f6a;
        }

        .main {
            margin-left: 250px;
            padding: 30px;
        }

        .upload-card {
            background: white;
            width: 60%;
            margin: auto;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        .upload-box {
            border: 2px dashed #1f3c88;
            padding: 30px;
            border-radius: 12px;
            cursor: pointer;
            background: #f9fbff;
        }

        .upload-box:hover {
            background: #eef3ff;
        }

        input[type="file"] {
            display: none;
        }

        button {
            margin-top: 20px;
            padding: 12px 40px;
            background: #1f3c88;
            border: none;
            color: white;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #142b61;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>E-Office</h2>
    <a href="dashboard.php">📊 Dashboard</a>
    <a href="upload.php">📁 Upload Documents</a>
    <a href="view_docs.php">📂 View Documents</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<!-- Main Content -->
<div class="main">
    <h1>Upload Documents</h1>

    <div class="upload-card">
        <?php echo $message; ?>

        <form method="POST" enctype="multipart/form-data">

            <label for="fileInput">
                <div class="upload-box">
                    <img src="https://cdn-icons-png.flaticon.com/512/1828/1828778.png" width="60">
                    <h3>Click to Upload or Drag Files Here</h3>
                    <p>Supported: PDF, DOCX, JPG, PNG</p>
                </div>
            </label>

            <input type="file" id="fileInput" name="document" required>

            <button type="submit" name="submit">Upload</button>
        </form>
    </div>

</div>

</body>
</html>
