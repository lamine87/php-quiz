<h1>Modifier des questions</h1>
<form action="" method="post" enctype="multipart/form">
    <input type="text" class="form-control" value="<?php echo $question->getIntitule(); ?>" required name="intitule">

    <div class="mt-2">
        <button type="button" class="btn btn-dark btn-sm" id="bt-add-reponse">Ajouter une réponse</button>
    </div>
    <div id="reponses-container" class="">
        <?php
        // $i = 0;
        foreach ($question->getReponses() as $reponse) {
        ?>
            <div class="form-group">
                <label>Intitulé</label>
                <input type="text" class="form-control" name="reponses[<?php echo $reponse->getId(); ?>]" value="<?php echo $reponse->getTexte(); ?>">
                <div class="checkbox">
                    <input type="checkbox" name="results[<?php echo $reponse->getId(); ?>]" id="checkbox<?php echo $reponse->getId(); ?>" <?php if ($reponse->getIsTrue()) echo "checked"; ?>>
                    <label for="checkbox<?php echo $reponse->getId(); ?>">Bonne Réponse</label>
                </div>
            </div>
        <?php
            //$i++;
        }
        ?>
    </div>

    <div class="text-end mt-3">
        <button type="submit" class="btn btn-dark">Valider</button>
    </div>
</form>
<script>
    $("#bt-add-reponse").on("click", function(event) {
        // On récupère le nombre de form-group se trouvant dans le container des réponses afin de déterminer l'index de la réponse à insérer
        //var num = $("#reponses-container").find(".form-group").length;
        var num = <?php echo $reponse->getId() + 1; ?>;
        $("#reponses-container").append('<div class="form-group"><label>Réponse</label><input type="text" name="reponses[]" class="form-control"><div class="checkbox"><input type="checkbox" name="results[' + num + ']" id="check' + num + '"><label for="check' + num + '">Bonne réponse</label></div></div>')
    });
</script>