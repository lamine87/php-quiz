<h1> Ajouter une question </h1>
<form action="" method="post" enctype="multipart/form">
    <div class="form-group">
        <label for="intitule">Intitulé</label>
        <input type="text" name="intitule" id="intitule" class="form-control" placeholder="Intitulé">
    </div>
    <div class="mt-2">
        <button type="button" class="btn btn-dark btn-sm" id="bt-add-reponse">Ajouter une réponse</button>
    </div>
    <div id="reponses-container" class=""></div>

    <div class="text-end mt-3">
        <button type="submit" class="btn btn-dark">Valider</button>
    </div>
</form>
<script>
    $("#bt-add-reponse").on("click", function(event) {
        // On récupère le nombre de form-group se trouvant dans le container des réponses afin de déterminer l'index de la réponse à insérer
        var num = $("#reponses-container").find(".form-group").length;
        $("#reponses-container").append('<div class="form-group"><label>Réponse</label><input type="text" name="reponses[]" class="form-control"><div class="checkbox"><input type="checkbox" name="results[' + num + ']" id="check' + num + '"><label for="check' + num + '">Bonne réponse</label></div></div>')
    });
</script>