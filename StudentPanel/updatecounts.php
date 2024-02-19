<?php
include_once "../connection.php";

if(isset($_POST['correctCount']) && isset($_POST['incorrectCount']) && isset($_POST['Id'])) {
    $Id = $_POST['Id'];
    $correctCount = $_POST['correctCount'];
    $incorrectCount = $_POST['incorrectCount'];

    $update_query = $conn->prepare("UPDATE sptests SET Correct = ?, Wrong = ? WHERE Id = ?");
    $update_query->execute([$correctCount, $incorrectCount, $Id]);

    echo "Sptest tablosu güncellendi.";
} else {
    echo "POST verileri eksik";
}
?>
