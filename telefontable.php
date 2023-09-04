<?php
require_once 'telislem.php';
$sql_select = "SELECT * FROM telefon";
$result = $conn->query($sql_select);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telefon Bilgi Formu</title>
    <link rel="stylesheet" href="table.css">
</head>

<body>
    <nav>
        <div class="container">
            <div class="logo">
                <img src="image/TÜMOSAN_logo.svg.png" alt="Tümosan Logo">
            </div>
        </div>
    </nav>
    <h2>Telefon Özellikleri</h2><br><br>
    <div class="container-form2">

        <table border="1">
            <tr>
                <th>Kullanıcı Adı ve Soyadı</th>
                <th>IP No</th>
                <th>Model</th>
                <th>Mac Adresi</th>
                <th>İşlem</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td class='user-name'>" . $row["adi_soyadi"] . "</td>
                        <td contenteditable='true' class='user-ip-no'>" . $row["ip_no"] . "</td>
                        <td contenteditable='true' class='user-model'>" . $row["model"] . "</td>
                        <td contenteditable='true' class='user-mac-adresi'>" . $row["mac_adresi"] . "</td>
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
                const ipNo = row.querySelector('.user-ip-no').textContent;
                const model = row.querySelector('.user-model').textContent;
                const macAdresi = row.querySelector('.user-mac-adresi').textContent;

                fetch('telefon_update.php', {
                    method: 'POST',
                    body: JSON.stringify({ id, name, ipNo, model, macAdresi }),
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

                fetch('telefon_delete.php?id=' + id, {
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
