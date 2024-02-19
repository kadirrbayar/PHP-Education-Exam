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
$name = validate($_POST['name']);
$username = validate($_POST['username']);
$mail = validate($_POST['mail']);
$oldPassword = validate($_POST['oldpassword']);
$newPassword = validate($_POST['password']);
$confirmPassword = validate($_POST['confirmpassword']);

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
        $stmt = $conn->prepare("SELECT password FROM users WHERE Id = :userId");
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
            $updatePasswordStmt = $conn->prepare("UPDATE users SET Password = :password WHERE Id = :userId");
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
elseif(empty($username)){
    header("Location: profile.php?error=" . urlencode("Kullanıcı adı alanı boş geçilemez"));
    exit();
}
else {
    $updateStmt = $conn->prepare("UPDATE users SET Name = :name, Mail = :mail, Username = :username WHERE Id = :userId");
    $updateStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $updateStmt->bindParam(':name', $name, PDO::PARAM_STR);
    $updateStmt->bindParam(':mail', $mail, PDO::PARAM_STR);
    $updateStmt->bindParam(':username', $username, PDO::PARAM_STR);
    $updateStmt->execute();
}

$_SESSION['Username'] = $username;
$_SESSION['Name'] = $name;
$_SESSION['Mail'] = $mail;

header("Location: profile.php?error=" . urlencode("Profil bilgileriniz başarıyla güncellendi."));
echo '<script>alert("Profil bilgileriniz başarıyla güncellendi")</script>';
exit();

?>
