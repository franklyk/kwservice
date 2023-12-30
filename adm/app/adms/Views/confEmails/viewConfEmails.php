<?php

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
        
    echo "<h2>Detalhes da Configuração de E-mail</h2>";

    echo "<a href='".URLADM."list-conf-emails/index'>Listar</a><br>";
    if(!empty($this->data['viewConfEmails'])){
        echo "<a href='" . URLADM . "edit-conf-emails/index/" . $this->data['viewConfEmails'][0]['id'] . "'>Editar</a><br>";
        echo "<a href='" . URLADM . "edit-conf-emails-password/index/" . $this->data['viewConfEmails'][0]['id'] . "'>Editar Senha</a><br>";
        echo "<a href='" . URLADM . "delete-conf-emails/index/" . $this->data['viewConfEmails'][0]['id'] . "' onclick='return confirm(\"Tem certeza que deseja apagar este ítem?\")>Apagar</a><br><br>";
    }

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    if ($this->data['viewConfEmails']) {
        // var_dump($this->data);
        extract($this->data['viewConfEmails'][0]);

        echo "ID: $id <br>";

        echo "Titulo: <span>$title</span> <br>";
        echo "Nome: <span>$name</span> <br>";
        echo "E-mail: <span>$email</span> <br>";
        echo "Host: <span>$host</span> <br>";
        echo "Usuário: <span>$username</span> <br>";
        echo "SMTP: <span>$smtpsecure</span> <br>";
        echo "Porta: <span>$port</span> <br>";
        echo "Cadastrada em:" . date('d/m/Y', strtotime($created)) ."<br>";
        echo "Modificada em:";
        if(!empty($modified)){
            echo date('d/m/Y', strtotime($modified));
        }
        echo "<br>";
    }
