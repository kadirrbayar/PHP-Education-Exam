<?php
include_once '../connection.php';
session_start();
$testId = isset($_POST['testId']) ? $_POST['testId'] : null;
if ($testId !== null) {
    $stmt = $conn->prepare("DELETE FROM sptests WHERE Id = :test_id");
    $stmt->bindParam(':test_id', $testId, PDO::PARAM_INT);
    $stmt->execute();
    echo "Silindi.";
} else {
    echo "Hata: Silinecek ID belirtilmedi.";
}
?>