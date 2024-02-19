<?php
session_start();

if (!isset($_SESSION['soru_sepeti'])) {
    $_SESSION['soru_sepeti'] = array();
}
$soruid = isset($_POST['soruId']) ? $_POST['soruId'] : null;
if ($soruid !== null) {
    if (($key = array_search($soruid, $_SESSION['soru_sepeti'])) !== false) {
        unset($_SESSION['soru_sepeti'][$key]);
        echo "Başarıyla sepetten çıkarıldı.";
    } else {
        echo "Hata: Belirtilen ID dizide bulunamadı.";
    }
} else {
    echo "Hata: Silinecek ID belirtilmedi.";
}
?>
