<?php
session_start();
include_once 'connection.php';

if (isset($_POST['message']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = validate($_POST['name']);
    $message = validate($_POST['message']);
    $subject = validate($_POST['subject']);
    $email = validate($_POST['email']);

    if (empty($name)) {
        header("Location: contact.php?error=" . urlencode("Ad alanı boş geçilemez"));
        exit();
    } else if (strlen($name) > 120) {
        header("Location: contact.php?error=" . urlencode("Ad alanı 120 karakterden fazla olamaz."));
        exit();
    } else if (empty($message)) {
        header("Location: contact.php?error=" . urlencode("Mesaj alanı boş bırakılamaz"));
        exit();
    } else if (empty($subject)) {
        header("Location: contact.php?error=" . urlencode("Konu alanı boş bırakılamaz"));
        exit();
    } else if (strlen($subject) > 120) {
        header("Location: contact.php?error=" . urlencode("Konu alanı 120 karakterden fazla olamaz"));
        exit();
    } else if (empty($email)) {
        header("Location: contact.php?error=" . urlencode("Mail alanı boş bırakılamaz"));
        exit();
    } else if (strlen($email) > 120) {
        header("Location: contact.php?error=" . urlencode("Mail alanı 120 karakterden fazla olamaz."));
        exit();
    } else if (strlen($message) > 255) {
        header("Location: contact.php?error=" . urlencode("Mesaj uzunluğu 255 karakterden fazla olamaz"));
        exit();
    } else {
        $date = date('Y-m-d H:i:s');
        $insert_query = "INSERT INTO message(name, message, subject, date, mail) VALUES (?, ?, ?, ?, ?)";
        $insert = $conn->prepare($insert_query);
        $insert->execute([$name, $message, $subject, $date, $email]);
        header("Location: contact.php?success=" . urlencode("Başarıyla mesajınız gönderildi. Size en kısa sürede yanıt verilecektir."));
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
