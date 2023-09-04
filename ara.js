function search() {
    var searchBoxValue = $("#searchBox").val();

    if (searchBoxValue.trim() !== "") {
        $.ajax({
            url: "araislem.php", // Bu dosya verileri çekecek ve döndürecek
            type: "GET",
            data: { adi_soyadi: searchBoxValue },
            success: function (data) {
                $("#searchResults").html(data);
                $("#searchResults").css("display", "block");
            },
            error: function (error) {
                console.log("Arama hatası: " + error);
            }
        });
    }
}
