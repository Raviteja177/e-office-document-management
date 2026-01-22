<?php
include "db_connect.php";
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Fetch documents
$sql = "SELECT * FROM documents ORDER BY uploaded_at DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Documents - E-Office</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 20px;
        }

        .container {
            width: 90%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background: #0073ff;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background: #f1f1f1;
        }

        .btn-download, .btn-delete {
            padding: 7px 12px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
        }

        .btn-download {
            background: green;
        }

        .btn-delete {
            background: red;
        }

        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📄 Uploaded Documents</h2>

    <a href="dashboard.php" class="back-btn">⬅ Back to Dashboard</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Document Name</th>
            <th>Uploaded By</th>
            <th>Date</th>
            <th>Action</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['file_name']."</td>
                        <td>".$row['uploaded_by']."</td>
                        <td>".$row['uploaded_at']."</td>
                        <td>
                            <a class='btn-download' href='uploads/".$row['file_name']."' download>Download</a>
                            <a class='btn-delete' href='delete_doc.php?id=".$row['id']."'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='text-align:center;'>No documents found</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
