<?php
session_start();
require_once 'islem.php';

// AJAX isteğinden gelen verileri alın
$data = json_decode(file_get_contents('php://input'));

if ($data) {
    $id = $data->id;
    $new_ip = $data->ip;
    $new_adi = $data->adi;
    $new_yeri = $data->yeri;


    // Veritabanında güncelleme işlemi gerçekleştirin
    $conn = new mysqli('localhost', 'root', '', 'users');

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    $sql = "UPDATE kameralar SET ip='$new_ip', adi='$new_adi', yeri='$new_yeri' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Güncelleme başarılı";
    } else {
        echo "Güncelleme hatası: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Geçersiz veri";
}
?>