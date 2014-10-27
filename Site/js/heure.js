function loadSeanceList() {
    console.log("test");

    var annee_scolaire = $("#annee_scolaire").val();
    var composante = $("#composante").val();
    var prof = $("#prof").val();
    var url = "index.php?page=heure&annee_scolaire=" + annee_scolaire + "&composante=" + composante + "&prof=" + prof + "&json&" + Math.random();

    $.ajax({
        type: "GET",
        url: url,
        cache: false,
        dateType: 'json',
        success: function(data) {
            var json = JSON.parse(data);
            $("#tableContent").html(json.new_table);
            $(".sortTable").trigger("update");
        },
        error: function(data) {
            console.log(data);
        }
    });

    return false;
}

$(document).ready(function() {
    $("#prof").change(loadSeanceList);
});
