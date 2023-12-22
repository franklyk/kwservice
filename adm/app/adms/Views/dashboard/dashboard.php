<?php 

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    echo "VIEW - Página Dashboard!<br>";
    // echo $this->data . " " . $_SESSION['user_name'] . "! <br>";

?>