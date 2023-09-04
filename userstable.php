
<?php
require_once 'islem.php';
$sql_select = "SELECT * FROM kullanicilar";
$result = $conn->query($sql_select);



?>


<!-- userstable.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Bilgi Formu</title>
    <link rel="stylesheet" href="table.css">
</head>

<body>
    <nav>
        <div class="container ">
            <div class="logo">
                <img src="image/TÜMOSAN_logo.svg.png" alt="Tümosan Logo">
            </div>
        </div>
    </nav>
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
                <th>İşlemler</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td contenteditable='true' class='user-name'>" . $row["adi_soyadi"] . "</td>
                            <td contenteditable='true' class='user-sicil-no'>" . $row["sicil_no"] . "</td>
                            <td contenteditable='true' class='user-sirket-adi'>" . $row["sirket_adi"] . "</td>
                            <td contenteditable='true' class='user-eposta'>" . $row["e_posta"] . "</td>
                            <td contenteditable='true' class='user-tel-no'>" . $row["tel_no"] . "</td>
                            <td contenteditable='true' class='user-sirket-hatti'>" . $row["sirket_hatti"] . "</td>
                            <td>
                                <button class='update-button' data-id='" . $row["id"] . "'>Güncelle</button>
                                <button class='delete-button' data-id='" . $row["id"] . "'>Sil</button>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Veri bulunamadı.</td></tr>";
            }
            ?>
        </table>
    </div>

    <script>
        // Güncelleme işlemi için JavaScript kullanımı
        const updateButtons = document.querySelectorAll('.update-button');
        const deleteButtons = document.querySelectorAll('.delete-button');

        // Güncelleme işlemi için AJAX
        updateButtons.forEach(button => {
            button.addEventListener('click', () => {
                const row = button.closest('tr');
                const id = button.getAttribute('data-id');
                const name = row.querySelector('.user-name').textContent;
                const sicilNo = row.querySelector('.user-sicil-no').textContent;
                const sirketAdi = row.querySelector('.user-sirket-adi').textContent;
                const eposta = row.querySelector('.user-eposta').textContent;
                const telNo = row.querySelector('.user-tel-no').textContent;
                const sirketHatti = row.querySelector('.user-sirket-hatti').textContent;

                fetch('user_update.php', {
                    method: 'POST',
                    body: JSON.stringify({ id, name, sicilNo, sirketAdi, eposta, telNo, sirketHatti }),
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

                fetch('user_delete.php?id=' + id, {
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
</body>

</html>
