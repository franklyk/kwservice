<?php

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    echo "<h2>Listar Configurações de E-mails</h2>";
    echo "<a href='".URLADM."add-conf-emails/index'>Cadastrar</a><br><br>";

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    
    foreach($this->data['listConfEmails'] as $confEmail){
        // var_dump($this->data);

        //Modo otimizados de consultar os dados
        extract($confEmail);

        echo "ID: $id <br>";
        echo "Titulo: $title<br>";
        echo "Nome: $name<br>";
        echo "E-mail: $email<br>";
        echo "<a href='".URLADM."view-conf-emails/index/$id'>Visualizar</a><br>";
        echo "<a href='".URLADM."edit-conf-emails/index/$id'>Editar</a><br>";
        echo "<a href='".URLADM."delete-conf-emails/index/$id'>Apagar</a><br><br>";
        echo "<hr>";
    }
    echo $this->data['pagination'];
    
    // var_dump($this->data['pagination']);
?>