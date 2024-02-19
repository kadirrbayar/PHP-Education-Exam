<?php
session_start();
if (!isset($_SESSION['soru_sepeti'])) {
    $_SESSION['soru_sepeti'] = array();
}
$soruid = isset($_POST['soruId']) ? $_POST['soruId'] : null;
if ($soruid !== null) {
    $_SESSION['soru_sepeti'][] = $soruid;
    echo "Başarıyla sepete eklendi.";
} else {
    echo "Hata: Eklenecek ID belirtilmedi.";
}
?>
