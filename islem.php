
<?php
$conn = new mysqli('localhost', 'root', '', 'users');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    //echo "Bağlantınız gerçekleşti"; 
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_SESSION['form_submitted'])) {
    $adi_soyadi = $_POST['adi_soyadi'];
    $sicil_no = $_POST['sicil_no'];
    $sirket_adi = $_POST['sirket_adi'];
    $e_posta = $_POST['e_posta'];
    $telefon = $_POST['tel_no'];
    $sirket_hatti = $_POST['sirket_hatti'];
    

    $sql = "INSERT INTO kullanicilar (adi_soyadi,sicil_no,sirket_adi,e_posta, tel_no,  sirket_hatti)
            VALUES ('$adi_soyadi','$sicil_no', '$sirket_adi', '$e_posta', '$telefon',  '$sirket_hatti')";
            
    if ($conn->query($sql) === TRUE) {
        $_SESSION['form_submitted'] = true;
        header("Location: form.php"); // Sayfayı yeniden yönlendir
        exit;
    } else {
        echo "Hata: " . $conn->error;
    }
}//bu sayfayı form sayfası için tasarladım kullanıcı verileri buraya bağlanıyor ve sql e verielr ksaydedilmiş oluyor
?>

 