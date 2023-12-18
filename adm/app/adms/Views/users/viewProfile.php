<?php
echo "<h2>Perfil</h2>";
if(!empty($this->data['viewProfile'])){
    /*echo "<a href='".URLADM."edit-users/index/" . $this->data['viewUser'][0]['id'] . "'>Editar</a><br>";
    echo "<a href='".URLADM."edit-users-password/index/" . $this->data['viewUser'][0]['id'] . "'>Editar Senha</a><br>";
    echo "<a href='".URLADM."edit-users-image/index/" . $this->data['viewUser'][0]['id'] . "'>Editar Imagem</a><br>";
    echo "<a href='".URLADM."delete-users/index/" . $this->data['viewUser'][0]['id'] . "'>Apagar</a><br><br>";*/
}

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

if ($this->data['viewProfile']) {

    // var_dump($this->data['viewProfile'][0]);

    extract($this->data['viewProfile'][0]);

    if((!empty($image)) and (file_exists("app/adms/assets/images/users/" . $_SESSION['user_id'] ."/$image"))){
        echo "<img src='" . URLADM . "app/adms/assets/images/users/" . $_SESSION['user_id'] ."/$image' width='100' height='100'><br><br>";
    }else{
        echo "<img src='" . URLADM . "app/adms/assets/images/users/usuário.png' width='100' height='100'><br><br>";
    }
    echo "Nome: $name <br>";
    echo "Apelido: $nickname <br>";
    echo "E-mail: $email <br>";
    echo "<br>";
}


// var_dump($this->data);