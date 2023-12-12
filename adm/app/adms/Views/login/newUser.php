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
            $name = $valorForm['name'];
        }
    ?>
    <label for="name"><strong>Nome</strong>: <span style="color:#f00;">*</span> </label>
    <input type="text" name="name" id="name" placeholder="Digite o nome completo" autocomplete="on" value="<?php echo $name ?>" required> <br><br>

    <?php 
    //$user - mantém os dados na INPUT user
        $email = "";
        if(isset($valorForm['email'])){
            $email = $valorForm['email'];
        }
    ?>
    <label for="email"><strong>E-mail</strong>: <span style="color:#f00;">*</span>  </label>
    <input type="email" name="email" id="email" placeholder="Digite o seu melhor e-mail" autocomplete="on" value="<?php echo $email ?>" required> <br><br>


    <?php 
    //$password - mantém os dados na INPUT password
        $password = "";
        if(isset($valorForm['password'])){
            $password = $valorForm['password'];}
    ?>
    <label for="password"><strong>Senha:</strong> <span style="color:#f00;">*</span> </label>
    <input type="text" name="password" id="password" placeholder="Digite a Senha" onkeyup="passwordStrength()" autocomplete="on" value="<?php echo $password ?>" required>
    <span id="msgViewStrength"><br><br></span>

    <span style="color:#f00;">* Campo Obrigatório!</span> <br><br>

    <button type="submit" name="SandNewUser" value="Cadastrar"><strong>Cadastrar</strong></button>

</form>

<p><a href=" <?php echo URLADM ?>">Clique aqui</a> para acessar</p>
