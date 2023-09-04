
<?php
require_once 'bilislem.php';
$sql_select = "SELECT * FROM bilgisayar";
$result = $conn->query($sql_select);



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilgisayar Bilgi Formu</title>
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
    <h2> Bilgisayar Özellikleri</h2><br><br>
    <div class="container-form2">
            
            <table border="1" >
                <tr>
                    <th>Kullanıcı Adı ve Soyadını</th>
                    <th>Bilgisayar Adı</th>
                    <th>Marka</th>
                    <th>Türü</th>
                    <th>İşlemci</th>
                    <th>RAM</th>
                    <th>Harddisk</th>
                    <th>Monitor</th>
                    <th>Office</th>
                    <th>İşletim Sistemi</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td>" . $row["adi_soyadi"] . "</td>
                        <td contenteditable='true'>" . $row["bilg_adi"] . "</td>
                        <td contenteditable='true'>" . $row["marka"] . "</td>
                        <td contenteditable='true'>" . $row["türü"] . "</td>
                        <td contenteditable='true'>" . $row["islemci"] . "</td>
                        <td contenteditable='true'>" .$row["ram"] . "</td>
                        <td contenteditable='true'>" . $row["harddisk"] . "</td>
                        <td contenteditable='true'>" . $row["monitor"] . "</td>
                        <td contenteditable='true'>" . $row["office"] . "</td>
                        <td contenteditable='true'>" . $row["isletim_sis"] . "</td>

                        <td>
                            <button class='update-button' data-id='" . $row["id"] . "'>Güncelle</button>
                            <button class='delete-button' data-id='" . $row["id"] . "'>Sil</button>
                        </td>
                    </tr>" ;
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
                const name = row.querySelector('td:nth-child(1)').textContent;
                const bilg_adi = row.querySelector('td:nth-child(2)').textContent;
                const marka = row.querySelector('td:nth-child(3)').textContent;
                const turu = row.querySelector('td:nth-child(4)').textContent;
                const islemci = row.querySelector('td:nth-child(5)').textContent;
                const ram = row.querySelector('td:nth-child(6)').textContent;
                const harddisk = row.querySelector('td:nth-child(7)').textContent;
                const monitor = row.querySelector('td:nth-child(8)').textContent;
                const office = row.querySelector('td:nth-child(9)').textContent;
                const isletim_sis = row.querySelector('td:nth-child(10)').textContent;

                fetch('bilgisayar_update.php', {
                    method: 'POST',
                    body: JSON.stringify({ id, name, bilg_adi, marka, turu, islemci, ram, harddisk, monitor, office, isletim_sis}),
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

                fetch('bilgisayar_delete.php?id=' + id, {
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