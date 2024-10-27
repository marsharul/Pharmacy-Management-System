<?php

include_once '../init.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    extract($_GET);
    $db = dbConn();

    // Fetch file name before deleting
    $sql_fetch_file = "SELECT ProfileImage FROM employee WHERE UserId='$userid'";
    $result_fetch_file = $db->query($sql_fetch_file);
    $row = $result_fetch_file->fetch_assoc();
    $profile_image = $row['ProfileImage'];

    // Delete query

    $sql = "DELETE users, employee FROM users INNER JOIN employee ON users.UserId = employee.UserId WHERE users.UserId = '$userid'";
    $result = $db->query($sql);

    // Check if deletion was successful
    if ($result) {
        // Delete file from server
        $file_path = '../../upload_images/' . $profile_image; // Adjust path as needed
        if (unlink($file_path)) {
            echo "File was deleted successfully."; // Deletes the file from the server
        } else {
            echo "Failed to delete the file.";
        }
        // Redirect or do any other necessary actions
        header("Location:manage.php");
    } else {
        // Handle deletion failure
    }
}
