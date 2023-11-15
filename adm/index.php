<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KWService - ADMINISTRATIVO</title>
</head>
<body>
    <?php 
        //Carregaro Composer
        require './vendor/autoload.php';

        //Instanciar a classe ConfigController, Responsável em tratar a URL      
        $home = new Core\ConfigController();
        //Instanciar o método para instanciar a pagina/controller 
        $home->loadPage();
    ?>
</body>
</html>