<?php
session_start();
include_once '../connection.php';

if (isset($_POST['title']) && isset($_POST['date'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $title = validate($_POST['title']);
    $date = validate($_POST['date']);
    $id = $_GET['Id'];

    if (empty($id)) {
        if (empty($title)) {
            header("Location: events.php?error=" . urlencode("Başlık alanı gereklidir."));
            exit();
        } else if (empty($date)) {
            header("Location: events.php?error=" . urlencode("Tarih alanı gereklidir."));
            exit();
        }
        else {
            $insert_query = "INSERT INTO event(Description, Date) VALUES (?, ?)";
            $insert = $conn->prepare($insert_query);
            $insert->execute([$title, $date]);
            header("Location: listevents.php");
            exit();
        }
    }
    else
    {
        if (empty($title)) {
            header("Location: editevents.php?Id=$id&&error=" . urlencode("Başlık alanı gereklidir."));
            exit();
        } else if (empty($date)) {
            header("Location: editevents.php?Id=$id&&error=" . urlencode("Tarih alanı gereklidir."));
            exit();
        }
        else
        {
            $update_query = "UPDATE event SET Description = ?, Date = ? WHERE Id = ?";
            $update = $conn->prepare($update_query);
            $update->execute([$title, $date, $id]);
            header("Location: listevents.php");
            exit();
        }
    }

} else {
    header("Location: listevents.php");
    exit();
}
?>