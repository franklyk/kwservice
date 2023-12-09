<?php
echo "<h2>Detalhes do Usuário</h2>";

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

if ($this->data['viewUser']) {
    var_dump($this->data['viewUser'][0]);
    extract($this->data['viewUser'][0]);

    echo "ID: $id <br>";
    echo "Nome: $name <br>";
    echo "Apelido: $nickname <br>";
    echo "E-mail: $email <br>";
    echo "Usuário: $user <br>";
    echo "Imagem: $image <br>";
    echo "Situação do usuário: $adms_sits_user_id <br>";
    echo "Cadastrado em:" . date('d/m/Y H:i:s', strtotime($created)) ."<br>";
    echo "Modificado em:";
    if(!empty($modified)){
        echo date('d/m/Y', strtotime($modified));
    }
    echo "<br>";
}


// var_dump($this->data);
