<?php 
    if(isset($this->data['form'])){
        $valorForm = $this->data['form'];
        var_dump($this->data['form']);
    }
    
    //Criptografar a senha
    //echo password_hash("123456a", PASSWORD_DEFAULT);
?>


<h1>Area Restrita</h1>
<form action="" method="post">
    <?php 
        $user = "";
        if(isset($valorForm['user'])){
            $user = $valorForm['user'];}
    ?>
    <label for="">Usuário</label><br>
    <input type="text" name="user" id="user" placeholder="Digite o usuário" value="<?php echo $user ?>"> <br><br>
    <?php 
        $password = "";
        if(isset($valorForm['password'])){
            $password = $valorForm['password'];}
    ?>
    <label for="">Senha</label><br>
    <input type="password" name="password" id="password" placeholder="Digite a Senha" value="<?php echo $password ?>">
    <br><br>


    <button type="submit" name="SandLogin" id="SandLogin" value="Acessar">Acessar</button>
</form>