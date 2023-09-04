<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ara.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Tümosan</title>
</head>
<body>
   
<div class="search-main">
    <input type="text" class="tbox-search" id="searchBox" placeholder="Kullanıcı Adı ve Soyadı">
    <button class="btn-search" onclick="search()">Ara</button>
    <div id="searchResults" style="display: none;"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="ara.js"></script>
</body>
</html>
