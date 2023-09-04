<?php
session_start();
require_once 'islem.php';

// AJAX isteğinden gelen verileri alın
$data = json_decode(file_get_contents('php://input'));

if ($data) {
    $id = $data->id;
    $new_name = $data->name;
    $new_sicil_no = $data->sicilNo;
    $new_sirket_adi = $data->sirketAdi;
    $new_e_posta = $data->eposta;
    $new_tel_no = $data->telNo;
    $new_sirket_hatti = $data->sirketHatti;

    // Veritabanında güncelleme işlemi gerçekleştirin
    $conn = new mysqli('localhost', 'root', '', 'users');

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    $sql = "UPDATE kullanicilar SET adi_soyadi='$new_name', sicil_no='$new_sicil_no', sirket_adi='$new_sirket_adi', e_posta='$new_e_posta', tel_no='$new_tel_no', sirket_hatti='$new_sirket_hatti' WHERE id=$id";

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