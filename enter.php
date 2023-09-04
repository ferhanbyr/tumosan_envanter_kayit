<?php
//ilk giriş kısmını tasarladım ve css kodları style.css de
session_start();

$kullaniciAdi = $_POST['username'] ?? null;
$sifre = $_POST['password'] ?? null;
$hata = '';

if ($_POST) {
    try {
        $db = new PDO('mysql:host=localhost;dbname=users;charset=utf8', 'root', '');
    } catch (PDOException $e) {
        echo "Veritabanı bağlantısı başarısız oldu: " . $e->getMessage();
    }
    $sorgu = $db->prepare("SELECT * FROM users WHERE username = :kullaniciAdi");
    $sorgu->execute(['kullaniciAdi' => $kullaniciAdi]);
    $kullanici = $sorgu->fetch(PDO::FETCH_ASSOC);
    
    if($kullanici){
    if ($sifre===$kullanici['password']) 
    {
        $_SESSION['username']=$kullaniciAdi;
        Header('Location:form.php');
        # code...
    }else{
        $hata='Şifreniz Hatalı';
    }
 }
 else {
    $hata= 'Böyle bir kullanıcı yok!';
 }
 }
/* burda PDO ile veritabanına bağlndım PDO diğer veritabanlarına da bağlanmamızı 
da sağlar diğer sayfalrda mysqli yi kullandım çünkü sadece mysqli kullanıyorum.*/
/*php kodları ile html aynı sayfada kullsnılması pek istenmez ama burada çok fazla giriş olmadığı içn aynı sayfada kullandım.*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tümosan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="c-image"></div>
    <div class="box">
        <div class="logo">
            <img src="image/TÜMOSAN_logo.svg.png" alt="">
        </div>
        <form action="enter.php" method="post">
            <div class="login">
                <input type="text" placeholder="Kullanıcı Adı" name="username" required><br><br>
                <input type="password" placeholder="Şifre" name="password" required><br><br>

                <input type="submit" value="Giriş"><br>
                <?php
                if ($hata) {
                    echo "<p style='color: white;text-align:center';>$hata</p>";
                }
                ?>
            </div>
         </form>
        </div>
        
</body>

