<?php
$conn = new mysqli('localhost', 'root', '', 'users');
if (!$conn) {
    die("connection failed:" . mysqli_connect_error());
}

if (isset($_GET['adi_soyadi'])) {
    $adi_soyadi = $_GET['adi_soyadi'];

    $user_query = "SELECT * FROM kullanicilar WHERE adi_soyadi = '$adi_soyadi'";
    $user_result = $conn->query($user_query);
    $user_row = $user_result->fetch_assoc();

    $computer_query = "SELECT * FROM bilgisayar WHERE adi_soyadi = '$adi_soyadi'";
    $computer_result = $conn->query($computer_query);

    $phone_query = "SELECT * FROM telefon WHERE adi_soyadi = '$adi_soyadi'";
    $phone_result = $conn->query($phone_query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tümosan</title>
    <link rel="stylesheet" href="araislem.css">
</head>
<body>

<h2>Kullanıcılar</h2><br><br>
<div class="container-form2">
    <table border="1">
        <tr>
            <th>Kullanıcı Adı ve Soyadı</th>
            <th>Sicil No</th>
            <th>Kullanıcı Adı</th>
            <th>E-Posta</th>
            <th>Telefon Numarası</th>
            <th>Şirket Hattı</th>
        </tr>
        <?php if ($user_result->num_rows > 0) : ?>
            <tr>
                <td><?php echo $user_row["adi_soyadi"]; ?></td>
                <td><?php echo $user_row["sicil_no"]; ?></td>
                <td><?php echo $user_row["sirket_adi"]; ?></td>
                <td><?php echo $user_row["e_posta"]; ?></td>
                <td><?php echo $user_row["tel_no"]; ?></td>
                <td><?php echo $user_row["sirket_hatti"]; ?></td>
            </tr>
        <?php else : ?>
            <tr>
                <td colspan='6'>Veri bulunamadı.</td>
            </tr>
        <?php endif; ?>
    </table>
</div>

<h2> Bilgisayar Özellikleri</h2><br><br>
<div class="container-form2">
    <table border="1">
        <tr>
        <th>Kullanıcı Adı ve Soyadı</th>
                    <th>Bilgisayar Adı</th>
                    <th>Marka</th>
                    <th>Türü</th>
                    <th>İşlemci</th>
                    <th>Monitor</th>
                    <th>RAM</th>
                    <th>Harddisk</th>
                    <th>Office</th>
                    <th>İşletim Sistemi</th>
        </tr>
        <?php while ($computer_row = $computer_result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $computer_row["adi_soyadi"]?></td>
                <td><?php echo $computer_row["bilg_adi"]; ?></td>
                <td><?php echo $computer_row["marka"]; ?></td>
                <td><?php echo $computer_row["türü"]; ?></td>
                <td><?php echo $computer_row["islemci"]?></td>
                <td><?php echo $computer_row["monitor"]?></td>
                <td><?php echo $computer_row["ram"]?></td>
                <td><?php echo $computer_row["harddisk"]?></td>
                <td><?php echo $computer_row["office"]?></td>
                <td><?php echo $computer_row["isletim_sis"]?></td>
                
            </tr>
           
        <?php endwhile; ?>
        
    </table>
</div>

<h2>Telefon Özellikleri</h2><br><br>
<div class="container-form2">
    <table border="1">
        <tr>
            <th>Kullanıcı Adı ve Soyadı</th>
            <th>IP No</th>
            <th>Model</th>
            <th>Mac Adresi</th>
            
        </tr>
        <?php while ($phone_row = $phone_result->fetch_assoc()) : ?>
            <tr>
            <td><?php echo $phone_row["adi_soyadi"]; ?></td>
                <td><?php echo $phone_row["ip_no"]; ?></td>
                <td><?php echo $phone_row["model"]; ?></td>
                <td><?php echo $phone_row["mac_adresi"]; ?></td>
                
            </tr>
        <?php endwhile; ?>
       
    </table>
</div>

</body>
</html>
                             