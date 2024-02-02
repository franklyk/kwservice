<?php 

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    

    // echo "VIEW - Página erro!<br>";
    var_dump($this->data);
    echo $this->data;

?>