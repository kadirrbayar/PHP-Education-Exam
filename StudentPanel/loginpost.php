<?php
session_start();
include_once '../connection.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $uname = validate($_POST['username']);
    $pass = validate($_POST['password']);

    if (empty($uname) || empty($pass)) {
        header("Location: login.php?error=" . urlencode("Kullanıcı adı ve şifre alanları boş bırakılamaz."));
        exit();
    }

    $sth = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $sth->bindParam(':username', $uname, PDO::PARAM_STR);
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    if ($row && password_verify($pass, $row['Password'])) {
        $_SESSION['Username'] = $row['Username'];
        $_SESSION['Name'] = $row['Name'];
        $_SESSION['Id'] = $row['Id'];
        $_SESSION['Mail'] = $row['Mail'];
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
