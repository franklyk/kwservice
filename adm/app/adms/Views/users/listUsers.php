<?php
    echo "<h2>Listar Usuários</h2>";

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    foreach($this->data['listUsers'] as $user){
        // var_dump($user);

        //Modo Extenso de consultar os dados
        // echo "ID:" . $user['id'] . "<br>";
        // echo "Nome:" . $user['name'] . "<br>";
        // echo "E-mail:" . $user['email'] . "<br><hr>";
        

        //Modo otimizados de consultar os dados
        extract($user);
        echo "ID: $id <br>";
        echo "Nome: $name <br>";
        echo "E-mail: $email <br><hr>";
    }
?>