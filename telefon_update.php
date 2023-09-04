<?php
session_start();
require_once 'islem.php';

// AJAX isteğinden gelen verileri alın
$data = json_decode(file_get_contents('php://input'));

if ($data) {
    $id = $data->id;
    $new_name = $data->name;
    $new_ip_no = $data->ipNo;
    $new_model = $data->model;
    $new_mac_adresi = $data->macAdresi;


    // Veritabanında güncelleme işlemi gerçekleştirin
    $conn = new mysqli('localhost', 'root', '', 'users');

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    $sql = "UPDATE telefon SET adi_soyadi='$new_name', ip_no='$new_ip_no', model='$new_model', mac_adresi='$new_mac_adresi' WHERE id=$id";

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