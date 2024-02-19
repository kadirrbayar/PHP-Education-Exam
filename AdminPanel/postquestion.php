<?php
session_start();
include_once '../connection.php';

if (
    isset($_POST['title']) &&
    isset($_POST['A']) &&
    isset($_POST['B']) &&
    isset($_POST['C']) &&
    isset($_POST['D']) &&
    isset($_POST['E']) &&
    isset($_POST['correct']) &&
    isset($_POST['bank'])
)
{

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $title = validate($_POST['title']);
    $A = validate($_POST['A']);
    $B = validate($_POST['B']);
    $C = validate($_POST['C']);
    $D = validate($_POST['D']);
    $E = validate($_POST['E']);
    $correct = validate($_POST['correct']);
    $bank = validate($_POST['bank']);

    if (empty($_GET['Id'])) {
        #Insert işlemi
        if (empty($title)) {
            header("Location: addquestion.php?error=" . urlencode("Soru adı gereklidir."));
            exit();
        } else if (empty($A)) {
            header("Location: addquestion.php?error=" . urlencode("A seçeneği gereklidir."));
            exit();
        } else if (empty($B)) {
            header("Location: addquestion.php?error=" . urlencode("B seçeneği gereklidir."));
            exit();
        } else if (empty($C)) {
            header("Location: addquestion.php?error=" . urlencode("C seçeneği gereklidir."));
            exit();
        } else if (empty($D)) {
            header("Location: addquestion.php?error=" . urlencode("D seçeneği gereklidir."));
            exit();
        } else if (empty($E)) {
            header("Location: addquestion.php?error=" . urlencode("E seçeneği gereklidir."));
            exit();
        } else if (empty($correct)) {
            header("Location: addquestion.php?error=" . urlencode("Doğru cevap seçeneği gereklidir."));
            exit();
        } else if (empty($bank)) {
            header("Location: addquestion.php?error=" . urlencode("Soru bankası adı gereklidir."));
            exit();
        }
        else
        {
            $insert_query = "INSERT INTO tests(Title, A, B,C,D,E,Correct,book_id) VALUES (?, ?, ?, ?, ?, ? , ?, ?)";
            $insert = $conn->prepare($insert_query);
            $insert->execute([$title, $A,$B,$C,$D,$E,$correct,$bank]);
            header("Location: questionbank.php");
            exit();
        }
    }
    else
    {
        $id = validate($_GET['Id']);
        if (empty($title)) {
            header("Location: editquestion.php?Id=$id&&error=" . urlencode("Soru adı gereklidir."));
            exit();
        } else if (empty($A)) {
            header("Location: editquestion.php?Id=$id&&error=" . urlencode("A seçeneği gereklidir."));
            exit();
        } else if (empty($B)) {
            header("Location: editquestion.php?Id=$id&&error=" . urlencode("B seçeneği gereklidir."));
            exit();
        } else if (empty($C)) {
            header("Location: editquestion.php?Id=$id&&error=" . urlencode("C seçeneği gereklidir."));
            exit();
        } else if (empty($D)) {
            header("Location: editquestion.php?Id=$id&&error=" . urlencode("D seçeneği gereklidir."));
            exit();
        } else if (empty($E)) {
            header("Location: editquestion.php?Id=$id&&error=" . urlencode("E seçeneği gereklidir."));
            exit();
        } else if (empty($correct)) {
            header("Location: editquestion.php?Id=$id&&error=" . urlencode("Doğru cevap seçeneği gereklidir."));
            exit();
        } else if (empty($bank)) {
            header("Location: editquestion.php?Id=$id&&error=" . urlencode("Soru bankası adı gereklidir."));
            exit();
        }
        else
        {
            $update_query = "UPDATE tests SET Title = ?, A = ?,B = ?,C = ?,D = ?,E = ?,Correct = ?,book_id = ? WHERE Id = ?";
            $update = $conn->prepare($update_query);
            $update->execute([$title, $A, $B, $C, $D, $E, $correct, $bank, $id]);
            header("Location: questionbank.php");
            exit();
        }
    }

} else {
    header("Location: questionbank.php");
    exit();
}
?>