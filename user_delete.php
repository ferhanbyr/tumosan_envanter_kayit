<?php
session_start();
require_once 'islem.php';

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];

    // Veritabanında silme işlemi gerçekleştirin
    $conn = new mysqli('localhost', 'root', '', 'users');

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    $sql = "DELETE FROM kullanicilar WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Silme başarılı";
    } else {
        echo "Silme hatası: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Geçersiz kullanıcı ID";
}
?>