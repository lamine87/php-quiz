<div class="d-flex justify-content-between align-items-center">
    <h1> Liste des questions </h1>
    <a href="question/new" class="btn btn-dark">Nouvelle question</a>
</div>

<?php


if (count($questions) == 0) {
    echo '<p> Aucune question dans la base de données</p>';
} else {

?>


    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Intitulé</th>
                <th class="text-end">Action</th>
            </tr>
        </thead>
        <?php
        foreach ($questions as $question) {
            echo '<tr><td>' . $question->getId() . '</td><td>' . $question->getIntitule() . '</td><td class="text-end"><a 
                href="question/delete/' . $question->getId() . '" 
                class="btn btn-danger">Supprimer</a><a href="question/edit/' . $question->getId() . '" 
                class="btn btn-dark">Modifier</a></td></tr>';
        }
        ?>

    </table>
<?php
}

?>