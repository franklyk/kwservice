<?php 
    //Verifica se existe dados no formulário, se houver mantém os dados no INPUT
    if(isset($this->data['form'])){
        $valorForm = $this->data['form'];
        // var_dump($this->data['form']);
    }
    if(isset($this->data['form'][0])){
        $valorForm = $this->data['form'][0];
        // var_dump($this->data['form']);
    }
    
    //Criptografar a senha
    //echo password_hash("123456a", PASSWORD_DEFAULT);
    // var_dump($this->data['form']);

?>

<h1>Editar Usuario</h1>


<?php 
echo "<a href='".URLADM."list-users/index'>Listar</a><br>";
if(isset($valorForm['id'])){
    echo "<a href='".URLADM."view-users/index/" . $valorForm['id'] . "'>Visualizar</a><br><br>";
}


    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>
<span id="msg"></span>

<form action="" method="post" id="form-edit-user">

    <?php 
    //$user - mantém os dados na INPUT user
        $id = "";
        if(isset($valorForm['id'])){
            $id = $valorForm['id'];
        }
    ?>
    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">

    <?php 
    //$user - mantém os dados na INPUT user
        $name = "";
        if(isset($valorForm['name'])){
            $name = $valorForm['name'];
        }
    ?>
    <label for="name"><strong>Nome:</strong> <span style="color:#f00;">*</span> </label><br>
    <input type="text" name="name" id="name" placeholder="Digite o nome completo" autocomplete="on"
        value="<?php echo $name ?>" required> <br><br>

    <?php 
    //$user - mantém os dados na INPUT user
        $nickname = "";
        if(isset($valorForm['nickname'])){
            $nickname = $valorForm['nickname'];
        }
    ?>
    <label for="name"><strong>Apelido:</strong> </label><br>
    <input type="text" name="nickname" id="nickname" placeholder="Digite o seu apelido" autocomplete="on"
        value="<?php echo $nickname ?>"> <br><br>

    <?php 
    //$user - mantém os dados na INPUT user
        $email = "";
        if(isset($valorForm['email'])){
            $email = $valorForm['email'];
        }
    ?>
    <label for="email"><strong>E-mail:</strong> <span style="color:#f00;">*</span> </label><br>
    <input type="text" name="email" id="email" placeholder="Digite o seu melhor e-mail" autocomplete="on"
        value="<?php echo $email ?>" required> <br><br>

    <?php 
//$user - mantém os dados na INPUT user
    $user = "";
    if(isset($valorForm['user'])){
        $user = $valorForm['user'];
    }
?>
    <label for="user"><strong>Usuário:</strong> <span style="color:#f00;">*</span></label><br>
    <input type="text" name="user" id="user" placeholder="Usuário para acesso ao Adm" autocomplete="on"
        value="<?php echo $user ?>" required> <br><br>


    <label for="user"><strong>Situção:</strong> <span style="color:#f00;">*</span> </label><br>
    <select name="adms_sits_user_id" id="adms_sits_user_id">
        <option value="">Selecione</option>
        <?php 
        foreach($this->data['select']['sit'] as $sit){
            extract($sit);
            if((isset($valorForm['adms_sits_user_id']))and ($valorForm['adms_sits_user_id'] == $id_sit)){
                echo "<option value='$id_sit' selected>$name_sit</option>";
            }else{
                echo "<option value='$id_sit'>$name_sit</option>";
            }
        }
        ?>
    </select><br><br>

    <span style="color:#f00;"><strong>* Campo Obrigatório!</strong></span> <br><br>

    <button type="submit" name="SendEditUser" value="Salvar"><strong>Salvar</strong></button>

</form>