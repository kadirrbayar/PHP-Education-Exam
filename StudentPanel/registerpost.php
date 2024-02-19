<?php
session_start();
include_once '../connection.php';

if (
    isset($_POST['username']) &&
    isset($_POST['password']) &&
    isset($_POST['name']) &&
    isset($_POST['re_password']) &&
    isset($_POST['mail'])
) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['username']);
    $pass = validate($_POST['password']);
    $re_pass = validate($_POST['re_password']);
    $name = validate($_POST['name']);
    $mail = validate($_POST['mail']);

    $user_data = 'username=' . $uname . '&name=' . $name;

    if (empty($uname)) {
        header("Location: register.php?error=" . urlencode("Kullanıcı adı gerekli") . "&user_data=" . urlencode($user_data));
        exit();
    } else if (empty($pass)) {
        header("Location: register.php?error=" . urlencode("Şifre alanı boş bırakılamaz") . "&user_data=" . urlencode($user_data));
        exit();
    } else if (empty($name)) {
        header("Location: register.php?error=" . urlencode("Ad alanı boş bırakılamaz") . "&user_data=" . urlencode($user_data));
        exit();
    } else if (empty($re_pass)) {
        header("Location: register.php?error=" . urlencode("Şifre tekrar alanı boş bırakılamaz") . "&user_data=" . urlencode($user_data));
        exit();
    } else if (empty($mail)) {
        header("Location: register.php?error=" . urlencode("Mail boş bırakılamaz") . "&user_data=" . urlencode($user_data));
        exit();
    } else if ($pass !== $re_pass) {
        header("Location: register.php?error=" . urlencode("Şifreler eşleşmiyor") . "&user_data=" . urlencode($user_data));
        exit();
    } else {

        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        $sth = $conn->prepare("SELECT * FROM users WHERE username='$uname'");
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if ($result > 0) {
            header("Location: register.php?error=" . urlencode("Kullanıcı adı kullanımda") . "&user_data=" . urlencode($user_data));
            exit();
        }

        $sty = $conn->prepare("SELECT * FROM users WHERE mail='$mail'");
        $sty->execute();
        $result2 = $sty->fetch(PDO::FETCH_ASSOC);
        if ($result2 > 0) {
            header("Location: register.php?error=" . urlencode("Mail kullanımda") . "&user_data=" . urlencode($user_data));
            exit();
        }

        $insert_query = "INSERT INTO users(username, password, name, mail) VALUES (?, ?, ?, ?)";
        $insert = $conn->prepare($insert_query);
        $insert->execute([$uname, $hashed_password, $name, $mail]);
        header("Location: login.php?success=" . urlencode("Başarıyla kayıt oldun şimdi giriş yap.") . "&user_data=" . urlencode($user_data));
        exit();
    }
} else {
    header("Location: register.php");
    exit();
}
?>
