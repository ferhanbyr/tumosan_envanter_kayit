

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tümosan</title>
    <link rel="stylesheet" href="genel.css">
</head>
<body>
<nav>
        <div class="container ">
        <div class="logo">
        <img src="image/TÜMOSAN_logo.svg.png" alt="Tümosan Logo">
    </div> 
    
    
</nav>
    <header>
     <div class="container-form">
     <h2>Bilgisayar Bilgi Formu</h2>
      <form action="bilislem.php" method="post">
          <div class="formexit">
      <input type="text" name="adi_soyadi"placeholder="Kullanıcı Adı ve Soyadı" ><br><br>
      <input type="text" name="bilgisayar_adi"placeholder="Bilgisayar Adı" ><br><br>
      <input type="text" name="marka"placeholder="Marka" ><br><br>
      <input type="text" name="türü"placeholder="Türü" ><br><br>
      <input type="text" name="islemci"placeholder="İşlemci" ><br><br>
      <input type="text" name="ram"placeholder="RAM" ><br><br>
      <input type="text" name="harddisk"placeholder="Harddisk" ><br><br>
      <input type="text" name="monitor"placeholder="Monitor" ><br><br>
      <input type="text" name="office"placeholder="Office" ><br><br>
      <input type="text" name="isletim_sis"placeholder="İşletim Sistemi" ><br><br>
      <input type="submit" value="Kaydet" >
      <a href="form.php"><button type="button">Anasayfa</button></a>
  
      </div>
  </form>
  </div>
  </header>   
</body>
</html>