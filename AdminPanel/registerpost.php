<?php
session_start();
include_once '../connection.php';

if (
    isset($_POST['name']) &&
    isset($_POST['password']) &&
    isset($_POST['confirmpassword']) &&
    isset($_POST['mail'])
) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $mail = validate($_POST['mail']);
    $pass = validate($_POST['password']);
    $repass = validate($_POST['confirmpassword']);
    $name = validate($_POST['name']);

    $user_data = 'mail=' . $mail . '&name=' . $name;

    if (empty($mail)) {
        header("Location: register.php?error=" . urlencode("Mail adresi gereklidir.") . "&user_data=" . urlencode($user_data));
        exit();
    } else if (empty($pass)) {
        header("Location: register.php?error=" . urlencode("Şifre alanı boş bırakılamaz") . "&user_data=" . urlencode($user_data));
        exit();
    } else if (empty($name)) {
        header("Location: register.php?error=" . urlencode("Ad alanı boş bırakılamaz") . "&user_data=" . urlencode($user_data));
        exit();
    } else if (empty($repass)) {
        header("Location: register.php?error=" . urlencode("Şifre tekrar alanı boş bırakılamaz") . "&user_data=" . urlencode($user_data));
        exit();
    } else if($pass !== $repass){
            header("Location: register.php?error=" . urlencode("Şifreler eşleşmiyor") . "&user_data=" . urlencode($user_data));
            exit();
    } else {
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
        $sth = $conn->prepare("SELECT * FROM admins WHERE mail='$mail'");
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if ($result > 0) {
            header("Location: register.php?error=" . urlencode("Mail adresi kullanımda") . "&user_data=" . urlencode($user_data));
            exit();
        }
        $insert_query = "INSERT INTO admins(name, password, mail) VALUES (?, ?, ?)";
        $insert = $conn->prepare($insert_query);
        $insert->execute([$name, $hashed_password, $mail]);
        header("Location: login.php?success=" . urlencode("Başarıyla kayıt oldun şimdi giriş yap.") . "&user_data=" . urlencode($user_data));
        exit();
    }
} else {
    header("Location: register.php");
    exit();
}
?>
