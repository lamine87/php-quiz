<?php 

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php 
    
    use controllers\AdminQuestionController;
    include('_head.php') 
    
    ?>
  
</head>
<body>
    <?php include('_admin-navbar.php') ?>
        <main class="container bg-white shadow">
         <?php

         if(isset($_SESSION['message'])){
             echo '<div class="alert alert-'.$_SESSION['message'][0].'">'.$_SESSION['message']["1"].'</div>';
             unset($_SESSION['message']);
         }
            ?>

            <?php

          //echo $_SERVER["HTTP_HOST"];
          $toAdmin = explode("/", $uri);
          //print_r($toAdmin);
          if(count($toAdmin) ==2){
              echo 'DASHBOARD';

          }else {
              if(in_array("question", $toAdmin)){
                  $controller = new AdminQuestionController();
                  if(count($toAdmin)>=4){
                    if($toAdmin[3]=="delete"){
                       if($controller->remove($toAdmin[4])){
                           // Tout est bon, message et redirection
                           $_SESSION['message']=["success","Question supprimée!"];
                       }else{
                        $_SESSION['message']=["danger","Un probleme est survenu."];
                       }
                       header('Location:'.ROOT_DIR.'/admin/question');
                    }if($toAdmin[3]=="new"){

                        // On verifie s'il existe des données postées dans la requête
                        if(!empty($_POST)){
                            // Ajout des la question en BDD
                            print_r($_POST);
                            $controller->add($_POST);
                        }
                        // Si non on affiche le formulaire d'ajout

                      require(__DIR__.'/question/new.php');
                     }
                }else{
                    $questions = $controller->findAll();
                  require (__DIR__.'/question/index.php');
               }
              }
          }
         ?>
    </main>
    <?php include('_admin-footer.php') ?>
</body>
</html>