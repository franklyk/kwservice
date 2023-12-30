<?php

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
        
    echo "<h2>Detalhes da Situação</h2>";

    echo "<a href='".URLADM."list-sits-users/index'>Listar</a><br>";
    if(!empty($this->data['viewSitUser'])){
        echo "<a href='" . URLADM . "edit-sits-users/index/" . $this->data['viewSitUser'][0]['id'] . "'>Editar</a><br>";
        echo "<a href='" . URLADM . "delete-sits-users/index/" . $this->data['viewSitUser'][0]['id'] . "' onclick='return confirm(\"Tem certeza que deseja apagar este ítem?\")>Apagar</a><br><br>";
    }

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    if ($this->data['viewSitUser']) {
        extract($this->data['viewSitUser'][0]);
        if((!empty($image)) and (file_exists("app/adms/assets/images/users/$id/$image"))){
            echo "<img src='" . URLADM . "app/adms/assets/images/users/$id/$image' width='100' height='100'><br><br>";
        }else{
            echo "<img src='" . URLADM . "app/adms/assets/images/users/usuário.png' width='100' height='100'><br><br>";
        }

        echo "ID: $id <br>";

        echo "Situação: <span style='color: $color;'>$name</span> <br>";
        echo "Cadastrada em:" . date('d/m/Y', strtotime($created)) ."<br>";
        echo "Modificada em:";
        if(!empty($modified)){
            echo date('d/m/Y', strtotime($modified));
        }
        echo "<br>";
    }
