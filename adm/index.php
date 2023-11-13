<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KWS - ADMINISTRATIVO</title>
</head>
<body>
    <?php 
        //Carregaro Composer
        require './vendor/autoload.php';

        //Instanciar a classe ConfigController, Reaponsável em tratar a URL      
        $home = new Core\ConfigController();
        //Instanciar o método para instanciar a pagina/contoller 
        $home->loadPage();
    ?>
</body>
</html>