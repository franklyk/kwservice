<?php 


    abstract class Config
    {
        protected function configAdm()
        {
            define('URL', 'http://localhost/adm/');
            define('URLADM', 'http://localhost/adm/users');

            define('CONTROLLER', 'Login');
            define('METODO', 'index');
            define('CONTROLLEERRO', 'Erro');

        }
    }
?>