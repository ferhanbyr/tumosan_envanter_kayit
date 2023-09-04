<?php
$conn = new mysqli('localhost', 'root', '', 'users');

if (!$conn) {
    die("connection failed:" . mysqli_connect_error());
} else { /*
    echo "Bağlantınız gerçekleşti"; */
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_SESSION['form_submitted'])) {
    $kamera_ip = $_POST['kamera_ip'];
    $kamera_adi = $_POST['kamera_adi'];
    $kamera_yeri = $_POST['kamera_yeri'];

    $sql = "INSERT INTO kameralar (ip, adi, yeri) VALUES ('$kamera_ip', '$kamera_adi', '$kamera_yeri')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['form_submitted'] = true; // Form gönderildiği işaretlenir
        header("Location: kamera.php"); // Sayfayı yeniden yönlendir
        exit;
    } else {
        echo "Hata: " . $conn->error;
    }
}

$sql_select = "SELECT * FROM kameralar";
$result = $conn->query($sql_select);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kamera Bilgi Formu</title>
    <link rel="stylesheet" href="swika.css">
</head>

<body>
    <nav>
        <div class="container ">
            <div class="logo">
                <img src="image/TÜMOSAN_logo.svg.png" alt="Tümosan Logo">
            </div>
        </div>
    </nav>
    <header>
        <div class="container-form">
            <h2>Kamera Bilgi Formu</h2>
            <form action="" method="post">
                <div class="formexit">
                    <input type="text" name="kamera_ip" placeholder="Kamera İP"><br><br>
                    <input type="text" name="kamera_adi" placeholder="Kamera Adı"><br><br>
                    <input type="text" name="kamera_yeri" placeholder="Kamera Konumu"><br><br>
                    <input type="submit" value="Kaydet">
                    <a href="form.php"><button type="button">Anasayfa</button></a>
                </div>
            </form>
        </div>
      
    </header>
    <h2>Kameralar</h2><br><br>
    <div class="container-form2">
            
            <table border="1" >
                <tr>
                    <th>Kamera İP</th>
                    <th>Kamera Adı</th>
                    <th>Kamera Konumu</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td contenteditable='true'>" . $row["ip"] . "</td>
                        <td contenteditable='true'>" . $row["adi"] . "</td>
                        <td contenteditable='true'>" . $row["yeri"] . "</td>
                        <td>
                            <button class='update-button' data-id='" . $row["id"] . "'>Güncelle</button>
                            <button class='delete-button' data-id='" . $row["id"] . "'>Sil</button>
                        </td> 
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Veri bulunamadı.</td></tr>";
                }
                ?>
            </table>
        </div>
</body>

<script>
        // Güncelleme işlemi için JavaScript kullanımı
        const updateButtons = document.querySelectorAll('.update-button');
        const deleteButtons = document.querySelectorAll('.delete-button');

        // Güncelleme işlemi için AJAX
        updateButtons.forEach(button => {
            button.addEventListener('click', () => {
                const row = button.closest('tr');
                const id = button.getAttribute('data-id');
                const ip = row.querySelector('td:nth-child(1)').textContent;
                const adi = row.querySelector('td:nth-child(2)').textContent;
                const yeri = row.querySelector('td:nth-child(3)').textContent;

                fetch('kamera_update.php', {
                    method: 'POST',
                    body: JSON.stringify({ id, ip, adi, yeri}),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    if (response.ok) {
                        // Güncelleme başarılı olduysa sayfayı yeniden yükleyin veya başka bir işlem yapın.
                        location.reload(); // Sayfayı yeniden yükleme örneği
                    }
                }).catch(error => {
                    console.error('Güncelleme hatası:', error);
                });
            });
        });

        // Silme işlemi için AJAX
        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');

                fetch('kamera_delete.php?id=' + id, {
                    method: 'DELETE'
                }).then(response => {
                    if (response.ok) {
                        // Silme başarılı olduysa sayfayı yeniden yükleyin veya başka bir işlem yapın.
                        location.reload(); // Sayfayı yeniden yükleme örneği
                    }
                }).catch(error => {
                    console.error('Silme hatası:', error);
                });
            });
        });
    </script>

</html>