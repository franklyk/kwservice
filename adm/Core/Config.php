<?php 


    abstract class Config
    {
        protected function configAdm()
        {
            define('URL', 'http://localhost/kwservice/');
            define('URLADM', 'http://localhost/kwservice/adm/');

            define('CONTROLLER', 'Login');
            define('METODO', 'index');
            define('CONTROLLEERRO', 'Erro');

        }
    }
?>