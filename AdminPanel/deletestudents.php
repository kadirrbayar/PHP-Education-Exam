<?php
session_start();
include_once '../connection.php';

if (isset($_GET['Id'])) {
    $id = $_GET['Id'];
    if (empty($id)) {
        header("Location: students.php");
        exit();
    }
    $delete_query = "DELETE FROM users WHERE Id = ?";
    $delete = $conn->prepare($delete_query);
    $delete->execute([$id]);
    header("Location: students.php");
    exit();
} else {
    header("Location: students.php");
    exit();
}
?>