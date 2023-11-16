<?php 
    //Verifica se existe dados no formulário, se houver mantém os dados no INPUT
    if(isset($this->data['form'])){
        $valorForm = $this->data['form'];
        // var_dump($this->data['form']);
    }
    
    //Criptografar a senha
    //echo password_hash("123456a", PASSWORD_DEFAULT);
?>

<h1>Novo Usuario</h1>
<?php 
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>
<span id="msg"></span>

<form action="" method="post" id="form-new-user">
    <?php 
    //$user - mantém os dados na INPUT user
        $name = "";
        if(isset($valorForm['name'])){
            $user = $valorForm['name'];
        }
    ?>
    <label for="">Nome: </label><br>
    <input type="text" name="name" id="name" placeholder="Digite o nome completo" value="<?php echo $name ?>" required> <br><br>

    <?php 
    //$user - mantém os dados na INPUT user
        $email = "";
        if(isset($valorForm['email'])){
            $email = $valorForm['email'];
        }
    ?>
    <label for="">E-mail: </label><br>
    <input type="text" name="email" id="email" placeholder="Digite o seu melhor e-mail" value="<?php echo $email ?>" required> <br><br>


    <?php 
    //$password - mantém os dados na INPUT password
        $password = "";
        if(isset($valorForm['password'])){
            $password = $valorForm['password'];}
    ?>
    <label for="">Senha</label><br>
    <input type="password" name="password" id="password" placeholder="Digite a Senha" value="<?php echo $password ?>" required>

    <br><br>

    <button type="submit" name="SandNewUser" value="Cadastrar">Cadastrar</button>

</form>

<p><a href=" <?php echo URLADM ?>">Clique aqui</a> para acessar</p>
