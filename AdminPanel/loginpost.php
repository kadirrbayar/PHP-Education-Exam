<?php
    session_start();
    include_once '../connection.php';

if (isset($_POST['mail']) && isset($_POST['password'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $mail = validate($_POST['mail']);
    $pass = validate($_POST['password']);

    if (empty($mail) || empty($pass)) {
        header("Location: login.php?error=" . urlencode("Mail ve şifre alanları boş bırakılamaz."));
        exit();
    }

    $sth = $conn->prepare("SELECT * FROM admins WHERE mail = :mail");
    $sth->bindParam(':mail', $mail, PDO::PARAM_STR);
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    if ($row && password_verify($pass, $row['Password'])) {
        $_SESSION['Mail'] = $row['Mail'];
        $_SESSION['Name'] = $row['Name'];
        $_SESSION['Id'] = $row['Id'];
        $_SESSION['Admin'] = true;
        header("Location: index.php");
        exit();
    } else {
        header("Location: login.php?error=" . urlencode("Kullanıcı adı ya da şifre yanlış!"));
        exit();
    }
}else{
    header("Location: login.php");
    exit();
}
