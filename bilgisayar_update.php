<?php
session_start();
require_once 'islem.php';

// AJAX isteğinden gelen verileri alın
$data = json_decode(file_get_contents('php://input'));

if ($data) {
    $id = $data->id;
    $new_name = $data->name;
    $new_bilg_adi = $data->bilg_adi;
    $new_marka = $data->marka;
    $new_turu = $data->turu;
    $new_islemci = $data->islemci;
    $new_ram = $data->ram;
    $new_harddisk = $data->harddisk;
    $new_monitor = $data->monitor;
    $new_office = $data->office;
    $new_isletim_sis = $data->isletim_sis;


    // Veritabanında güncelleme işlemi gerçekleştirin
    $conn = new mysqli('localhost', 'root', '', 'users');

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    $sql = "UPDATE bilgisayar SET adi_soyadi='$new_name', bilg_adi='$new_bilg_adi', marka='$new_marka', türü='$new_turu', islemci='$new_islemci', ram='$new_ram', harddisk='$new_harddisk', monitor='$new_monitor', office='$new_office', isletim_sis='$new_isletim_sis'  WHERE id=$id";

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