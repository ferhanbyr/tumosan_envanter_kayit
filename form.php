
<?php
//bu form.php içinde genel bir anasayfa tasrımı ve kullanıcı
// bilgileri için form tasarladım.veri tabanı bağlantısını islem.php de gerçekleştirdim.
//bu sayfanın css kodları form.css de
session_start();
if(empty($_SESSION['username'])){
        Header('Location:enter.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tümosan</title>

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="form.css">
</head>
<body>
     <nav>
        <div class="container ">
        <div class="logo">
        <img src="image/TÜMOSAN_logo.svg.png" alt="Tümosan Logo">
    </div>
          <div id="nav-links">
            <ul>
                <li class="nav-item text-uppercase">
                    <a href="arama.php" class="nav-link">
                        Arama
                    </a>
                </li>
                <li class="nav-item text-uppercase has-submenu">
                    <a href="#" class="nav-link">
                        Kategoriler

                    <ul class="submenu">
                        <li><a href="bilgisayar.php">Bilgisayar Bilgileri</a></li><br>
                        <li><a href="telefon.php">Telefon Bilgileri</a></li><br>
                        <li><a href="switch.php">Switch Bilgileri</a></li><br>
                        <li><a href="kamera.php">Kamera Bilgileri</a></li><br> 
                        <li><a href="yazici.php">Yazıcı Bilgileri</a></li><br>
                     </ul>
                </li>
                </a>
                <li class="nav-item text-uppercase has-submenu">
                    <a href="#" class="nav-link">
                        Tablolar
                        <ul class="submenu">
                        <li><a href="userstable.php">Kullanıcı Tablosu </a></li><br>
                        <li><a href="telefontable.php">Telefon Tablosu</a></li><br>
                        <li><a href="bilgisayartable.php">Bilgisayar Tablosu</a></li>
                     </ul>
                </li>
                    </a>
                </li>
                <li class="nav-item text-uppercase">
                    <a href="enter.php" class="nav-link">
                       Çıkış Yap
                    </a>
                </li>
            </ul>
          </div>
        </div>
    </nav>
   <header>
     
   <div class="container-form">
    <h2>Kullanıcı Bilgileri</h2>
    <form action="islem.php" method="post">
        <div class="formexit">
    <input type="text" name="adi_soyadi"placeholder="Kullanıcı Adı ve Soyadı" ><br><br>
    <input type="text" name="sicil_no"placeholder="Sicil No" ><br><br>
    <input type="text" name="sirket_adi"placeholder="Kullanıcı Adı" ><br><br>
    <input type="text" name="e_posta"placeholder="E-posta" ><br><br>
    <input type="text" name="tel_no"placeholder="Telefon Numarası" ><br><br>
    <input type="text" name="sirket_hatti"placeholder="Şirket Hattı" ><br><br>
    
    <input type="submit" value="Kaydet" >
   </div>
</form>
</div>
</header>
</body>
</html>