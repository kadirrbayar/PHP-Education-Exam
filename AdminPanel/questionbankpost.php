<?php
session_start();
include_once '../connection.php';

if (isset($_POST['title']) && isset($_POST['present']) && isset($_POST['ImageUrl'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $title = validate($_POST['title']);
    $present = validate($_POST['present']);
    $ImageUrl = validate($_POST['ImageUrl']);

    if (empty($title)) {
        header("Location: questionbank.php?error=" . urlencode("Soru bankası adı gereklidir."));
        exit();
    } else if (empty($present)) {
        header("Location: questionbank.php?error=" . urlencode("Yayın evi alanı gereklidir."));
        exit();
    } else if (empty($ImageUrl)) {
        header("Location: questionbank.php?error=" . urlencode("Görsel alanı gereklidir."));
        exit();
    }

    if (isset($_POST['Id'])) {
        $id = validate($_POST['Id']);
        $update_query = "UPDATE books SET Title = ?, ImageUrl = ?,Present = ? WHERE Id = ?";
        $update = $conn->prepare($update_query);
        $update->execute([$title, $ImageUrl, $present, $id]);
        header("Location: questionbank.php");
        exit();
    }
    else {
        $insert_query = "INSERT INTO books(Title, Present, ImageUrl) VALUES (?, ?, ?)";
        $insert = $conn->prepare($insert_query);
        $insert->execute([$title, $present, $ImageUrl]);
        header("Location: questionbank.php");
        exit();
    }
} else {
    header("Location: questionbank.php");
    exit();
}
?>