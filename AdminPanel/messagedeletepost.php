<?php
session_start();
include_once '../connection.php';

if (isset($_GET['Id'])) {
    $id = $_GET['Id'];
    if (empty($id)) {
        header("Location: messagelist.php");
        exit();
    }
    $delete_query = "DELETE FROM message WHERE Id = ?";
    $delete = $conn->prepare($delete_query);
    $delete->execute([$id]);
    header("Location: messagelist.php");
    exit();
} else {
    header("Location: messagelist.php");
    exit();
}
?>