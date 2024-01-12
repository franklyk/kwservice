<?php 

    namespace Core;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    abstract class Config
    {
        protected function configAdm()
        {
            define('URL', 'http://localhost/kwservice/');
            define('URLADM', 'http://localhost/kwservice/adm/');

            define('CONTROLLER', 'Login');
            define('METODO', 'index');
            define('CONTROLLERERRO', 'Login');

            define('HOST', 'localhost');
            define('USER', 'root');
            define('PASS', '');
            define('DBNAME', 'kwservice');
            define('PORT', 3306);


            define('EMAILADM', 'contato@kwservice.com');
            define('ADM', 'KWService');



            define('ICON_SETTINGS', '<i class="fa-solid fa-sliders"></i>');

            define('ICON_ADD', '<i class="fa-solid fa-plus"></i>');

            define('ICON_SEARCH', '<i class="fa-brands fa-sistrix"></i>');

            define('ICON_LIST', '<i class="fa-solid fa-magnifying-glass"></i>');

            define('ICON_ORDER', '<i class="fa-solid fa-angles-up"></i>');
            define('ICON_VIEW', '<i class="fa-regular fa-eye"></i>');
            define('ICON_EDIT', '<i class="fa-regular fa-pen-to-square"></i>');
            define('ICON_DELETE', '<i class="fa-regular fa-trash-can"></i>');

            define('ICON_CHECK', '<i class="fa-solid fa-check"></i></i>');




        }
    }
?>
<!-- <i class="fa-solid fa-ellipsis-vertical"></i> -->