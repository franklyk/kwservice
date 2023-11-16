<?php 
    session_start();
    ob_start();

    //Carregaro Composer
    require './vendor/autoload.php';

    //Instanciar a classe ConfigController, Responsável em tratar a URL      
    $home = new Core\ConfigController();
    //Instanciar o método para instanciar a pagina/controller 
    $home->loadPage();
?>
