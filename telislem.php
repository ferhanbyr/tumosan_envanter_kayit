
<?php
//telefon.php sadece veri girişini sağladım tablo listeleme kısmını da ayrı bir sayfada tasarlayacağım.
//genel.css e bağlı
$conn = new mysqli('localhost', 'root', '', 'users');
if (!$conn) {
    die("connection failed:" . mysqli_connect_error());
} else { 
   // echo "Bağlantınız gerçekleşti"; 
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_SESSION['form_submitted'])) {
    $adi_soyadi= $_POST['adi_soyadi'];
    $ip_no = $_POST['ip_no'];
    $model = $_POST['model'];
    $mac_adresi = $_POST['mac_adresi'];

    $sql = "INSERT INTO telefon (adi_soyadi,ip_no,model,mac_adresi) VALUES ('$adi_soyadi', '$ip_no ',
     '$model', ' $mac_adresi')";
     if ($conn->query($sql) === TRUE) {
        $_SESSION['form_submitted'] = true;
        header("Location: telefon.php"); // Sayfayı yeniden yönlendir
        exit;
    } else {
        echo "Hata: " . $conn->error;
    }
}
?>
