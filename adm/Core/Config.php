<?php 

    namespace Core;



    abstract class Config
    {
        protected function configAdm()
        {
            define('URL', 'http://localhost/kwservice/');
            define('URLADM', 'http://localhost/kwservice/adm/');

            define('CONTROLLER', 'login');
            define('METODO', 'index');
            define('CONTROLLERERRO', 'Erro');

            define('HOST', 'localhost');
            define('USER', 'root');
            define('PASS', '');
            define('DBNAME', 'kwservice');
            define('PORT', 3306);


            define('EMAILADM', 'contato@kwservice.com');

        }
    }
?>