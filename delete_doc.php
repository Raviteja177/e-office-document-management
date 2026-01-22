<?php
include "db_connect.php";
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['id'])) {
    $doc_id = $_GET['id'];

    // Fetch file name
    $sql = "SELECT file_name FROM documents WHERE id = $doc_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $file_name = $row['file_name'];

        // Delete file from folder
        $file_path = "uploads/" . $file_name;

        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Delete from database
        $delete_sql = "DELETE FROM documents WHERE id = $doc_id";
        mysqli_query($conn, $delete_sql);

        // Redirect to view docs page
        header("Location: view_docs.php?msg=deleted");
        exit;

    } else {
        echo "Document not found.";
    }
} else {
    echo "Invalid Request!";
}
?>
