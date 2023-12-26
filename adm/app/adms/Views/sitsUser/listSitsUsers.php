<?php

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    echo "<h2>Listar Situação</h2>";
    echo "<a href='".URLADM."add-sits-users/index'>Cadastrar</a><br><br>";

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    
    foreach($this->data['listSitsUsers'] as $sitUser){

        //Modo otimizados de consultar os dados
        extract($sitUser);
        echo "ID: $id <br>";
        echo "Nome: <span style='color:$color;'>$name</span><br>";
        echo "<a href='".URLADM."view-sits-users/index/$id'>Visualizar</a><br>";
        echo "<a href='".URLADM."edit-sits-users/index/$id'>Editar</a><br>";
        echo "<a href='".URLADM."delete-sits-users/index/$id'>Apagar</a><br><br>";
        echo "<hr>";
    }
?>