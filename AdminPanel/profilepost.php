<?php
include_once '../connection.php';
session_start();

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$userId = $_SESSION['Id'];
$name = validate($_POST['Name']);
$mail = validate($_POST['Mail']);
$oldPassword = validate($_POST['OldPassword']);
$newPassword = validate($_POST['Password']);
$confirmPassword = validate($_POST['NewPassword']);

if (!empty($newPassword) && $newPassword !== $confirmPassword) {
    header("Location: profile.php?error=" . urlencode("Yeni şifre ve tekrar şifre alanları uyuşmuyor."));
    exit();
}
if (!empty($newPassword)) {
    if (empty($oldPassword)) {
        header("Location: profile.php?error=" . urlencode("Eski şifre alanı boş geçilemez"));
        exit();
    }
    else {
        $stmt = $conn->prepare("SELECT password FROM admins WHERE Id = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!password_verify($oldPassword, $result['password'])) {
            header("Location: profile.php?error=" . urlencode("Eski şifre doğru değil."));
            exit();
        }
        else
        {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updatePasswordStmt = $conn->prepare("UPDATE admins SET Password = :password WHERE Id = :userId");
            $updatePasswordStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $updatePasswordStmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $updatePasswordStmt->execute();
        }
    }
}
if (empty($name)) {
    header("Location: profile.php?error=" . urlencode("Ad alanı boş geçilemez"));
    exit();
}
elseif (empty($mail)) {
    header("Location: profile.php?error=" . urlencode("Mail alanı boş geçilemez"));
    exit();
}
else
{
    $updateStmt = $conn->prepare("UPDATE admins SET Name = :name, Mail = :mail WHERE Id = :userId");
    $updateStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $updateStmt->bindParam(':name', $name, PDO::PARAM_STR);
    $updateStmt->bindParam(':mail', $mail, PDO::PARAM_STR);
    $updateStmt->execute();
}

$_SESSION['Name'] = $name;
$_SESSION['Mail'] = $mail;

header("Location: profile.php?error=" . urlencode("Profil bilgileriniz başarıyla güncellendi."));
exit();
?>
