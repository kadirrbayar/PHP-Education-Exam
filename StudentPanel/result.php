<?php
include_once "../connection.php";

if(isset($_POST['answers'])) {
    $Id = $_GET['Id'];
    $correctAnswers = [];
     $sorular = $conn->query("SELECT * FROM sptests WHERE Id = $Id")->fetch(PDO::FETCH_ASSOC);
     $test_ids = array_map('intval', explode(',', $sorular['test_id']));
     foreach ($test_ids as $test_id) {
         $tests_query = $conn->prepare("SELECT * FROM tests WHERE Id = ?");
         $tests_query->execute([$test_id]);
         if ($tests_query->rowCount() > 0) {
             $test_record = $tests_query->fetch(PDO::FETCH_ASSOC);
             $correctAnswers[$test_record['Id']] = $test_record['Correct'];
         }
     }

    $userAnswers = $_POST['answers'];
    $result = [
        'correctAnswers' => $correctAnswers,
        'userAnswers' => $userAnswers
    ];

    echo json_encode($result);
} else {
    echo json_encode(['error' => 'POST verileri eksik']);
}
?>
