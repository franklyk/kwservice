<?php

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
        
    echo "<h2>Detalhes da Cor</h2>";

    echo "<a href='".URLADM."list-colors/index'>Listar</a><br>";
    if(!empty($this->data['viewSitUser'])){
        echo "<a href='" . URLADM . "edit-sits-users/index/" . $this->data['viewSitUser'][0]['id'] . "'>Editar</a><br>";
        echo "<a href='" . URLADM . "delete-sits-users/index/" . $this->data['viewSitUser'][0]['id'] . "'>Apagar</a><br><br>";
    }

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    if ($this->data['viewColor']) {
        extract($this->data['viewColor'][0]);
        if((!empty($image)) and (file_exists("app/adms/assets/images/users/$id/$image"))){
            echo "<img src='" . URLADM . "app/adms/assets/images/users/$id/$image' width='100' height='100'><br><br>";
        }else{
            echo "<img src='" . URLADM . "app/adms/assets/images/users/usuário.png' width='100' height='100'><br><br>";
        }

        echo "ID: $id <br>";

        echo "Nome da cor: <span style='text-transform: uppercase;'>$name</span> <br>";
        // echo "Código hexadecimal: <span style='color: $color;'>$color</span> <br>";
        echo "Codigo hexadecimal:  <span style='text-transform: uppercase;'>$color</span><br>";
        echo "<div style='width:200px; height:30px; border:1px solid black; background-color:$color;'></div><br>";
        echo "Cadastrada em:" . date('d/m/Y', strtotime($created)) ."<br>";
        echo "Modificada em:";
        if(!empty($modified)){
            echo date('d/m/Y', strtotime($modified));
        }
        echo "<br>";
    }
