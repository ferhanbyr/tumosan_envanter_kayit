<?php
$conn = new mysqli('localhost', 'root', '', 'users');

if (!$conn) {
    die("connection failed:" . mysqli_connect_error());
} else { /*
    echo "Bağlantınız gerçekleşti"; */
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_SESSION['form_submitted'])) {
    $mac_adresi = $_POST['mac_adresi'];
    $model = $_POST['yazici_model'];
    $yazici_yeri = $_POST['yazici_yeri'];

    $sql = "INSERT INTO yazicilar (mac_adresi, model, yeri) VALUES ('$mac_adresi', '$model', '$yazici_yeri')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['form_submitted'] = true; // Form gönderildiği işaretlenir
        header("Location: yazici.php"); // Sayfayı yeniden yönlendir
        exit;
    } else {
        echo "Hata: " . $conn->error;
    }
}

$sql_select = "SELECT * FROM yazicilar";
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
            <h2>Yazıcı Bilgi Formu</h2>
            <form action="" method="post">
                <div class="formexit">
                    <input type="text" name="mac_adresi" placeholder="Mac Adresi"><br><br>
                    <input type="text" name="yazici_model" placeholder="Yazıcı Adı"><br><br>
                    <input type="text" name="yazici_yeri" placeholder="Yazıcı Konumu"><br><br>
                    <input type="submit" value="Kaydet">
                    <a href="form.php"><button type="button">Anasayfa</button></a>
                </div>
            </form>
        </div>
      
    </header>
    <h2>Yazıcılar</h2><br><br>
    <div class="container-form2">
            
            <table border="1" >
                <tr>
                    <th>Sicil No</th>
                    <th>Yazıcı Modeli</th>
                    <th>Yazıcı Yeri</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td contenteditable='true'>" . $row["mac_adresi"] . "</td>
                        <td contenteditable='true'>" . $row["model"] . "</td>
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
                const mac_adresi = row.querySelector('td:nth-child(1)').textContent;
                const model = row.querySelector('td:nth-child(2)').textContent;
                const yeri = row.querySelector('td:nth-child(3)').textContent;

                fetch('yazici_update.php', {
                    method: 'POST',
                    body: JSON.stringify({ id, mac_adresi, model, yeri}),
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

                fetch('yazici_delete.php?id=' + id, {
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