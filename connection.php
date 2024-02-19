<?php
try{
    $conn = new PDO("mysql:host=127.0.0.1;dbname=final;charset=utf8", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
    echo 'Veritabanı bağlantısı başarısız.';
    die();
}
