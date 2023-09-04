<?php
$conn = new mysqli('localhost', 'root', '', 'users');
if (!$conn) {
    die("connection failed:" . mysqli_connect_error());
} else { 
    //echo "Bağlantınız gerçekleşti"; 
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_SESSION['form_submitted'])) {
    $adi_soyadi= $_POST['adi_soyadi'];
    $bilgisayar_adi = $_POST['bilgisayar_adi'];
    $marka = $_POST['marka'];
    $türü = $_POST['türü'];
    $islemci = $_POST['islemci'];
    $monitor = $_POST['monitor'];
    $ram = $_POST['ram'];
    $harddisk = $_POST['harddisk'];
    $office = $_POST['office'];
    $isletim_sis = $_POST['isletim_sis'];
    

    $sql = "INSERT INTO bilgisayar (adi_soyadi,bilg_adi,marka,türü,islemci,monitor,ram,harddisk,office,isletim_sis) VALUES ('$adi_soyadi', '$bilgisayar_adi ',
     '$marka', ' $türü','$islemci','$monitor','$ram ','$harddisk','$office','$isletim_sis')";
     if ($conn->query($sql) === TRUE) {
        $_SESSION['form_submitted'] = true;
        header("Location: bilgisayar.php"); // Sayfayı yeniden yönlendir
        exit;
    } else {
        echo "Hata: " . $conn->error;
    }
}
?>