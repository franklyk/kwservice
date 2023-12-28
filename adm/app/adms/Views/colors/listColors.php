<?php

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    echo "<h2>Listar Cores</h2>";
    echo "<a href='".URLADM."add-colors/index'>Cadastrar</a><br><br>";

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    
    foreach($this->data['listColors'] as $Colors){
        // var_dump($this->data);
        //Modo otimizados de consultar os dados
        extract($Colors);
        echo "ID: $id <br>";
        echo "Nome da cor: <span style='text-transform: uppercase;'>$name</span><br>";
        echo "Codigo hexadecimal: <span style='text-transform: uppercase;'>$color</span><br>";
        echo "<div style='width:200px; height:30px; border:1px solid black; background-color:$color;'></div><br>";
        echo "<a href='".URLADM."view-colors/index/$id'>Visualizar</a><br>";
        echo "<a href='".URLADM."edit-colors/index/$id'>Editar</a><br>";
        echo "<a href='".URLADM."delete-colors/index/$id'>Apagar</a><br><br>";
        echo "<hr>";
    }
    echo $this->data['pagination'];
    // var_dump($this->data['pagination']);
?>