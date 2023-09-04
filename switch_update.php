<?php
session_start();
require_once 'islem.php';

// AJAX isteğinden gelen verileri alın
$data = json_decode(file_get_contents('php://input'));

if ($data) {
    $id = $data->id;
    $new_yeri = $data->yeri;
    $new_spr_modeli = $data->spr_modeli;


    // Veritabanında güncelleme işlemi gerçekleştirin
    $conn = new mysqli('localhost', 'root', '', 'users');

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    $sql = "UPDATE switch SET yeri='$new_yeri', spr_modeli='$new_spr_modeli' WHERE id=$id";

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