<?php

session_start();
if (!isset($_SESSION['soru_sepeti'])) {
    $_SESSION['soru_sepeti'] = array();
}
include_once '../connection.php';

if (isset($_POST['title']))
{
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $title = validate($_POST['title']);
    if (empty($title)) {
        header("Location: savequestion.php?error=" . urlencode("Ad alanı gereklidir."));
        exit();
    }
    $id = $_SESSION['Id'];

    if (!isset($_SESSION['soru_sepeti']) || empty($_SESSION['soru_sepeti'])) {
        header("Location: testtable.php");
        exit();
    }
    $test_id_values = implode(',', $_SESSION['soru_sepeti']);
    $insert_query = "INSERT INTO sptests(user_id, test_id, Title) VALUES (?, ?, ?)";
    $insert = $conn->prepare($insert_query);
    $insert->execute([$id, $test_id_values, $title]);
    unset($_SESSION['soru_sepeti']);
    header("Location: testtable.php");
    exit();
}
else {
    header("Location: index.php");
    exit();
}
?>