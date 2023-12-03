<?php 
    //Verifica se existe dados no formulário, se houver mantém os dados no INPUT
    if(isset($this->data['form'])){
        $valorForm = $this->data['form'];
    }

?>

<h1>KWService</h1>
<h1>Area Restrita</h1>
<?php 
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    
?>
     
<span id="msg"></span>

<form action="" method="post" id="form-login">
    <?php 
    //$user - mantém os dados na INPUT user
        $user = "";
        if(isset($valorForm['user'])){
            $user = $valorForm['user'];}
    ?>
    <label for="">Usuário</label><br>
    <input type="text" name="user" id="user" placeholder="Digite o usuário" value="<?php echo $user ?>"> <br><br>
    <?php 
    //$password - mantém os dados na INPUT password
        $password = "";
        if(!empty($valorForm['password'])){
            $password = $valorForm['password'];}
    ?>
    <label for="">Senha</label><br>
    <input type="text" name="password" id="password" placeholder="Digite a Senha" value="<?php echo $password ?>">
    <br><br>


    <button type="submit" name="SandLogin" id="SandLogin" value="Acessar">Acessar</button>
</form>

<<<<<<< HEAD
<p><a href="<?php echo URLADM ?>new-user/index">Cadastrar</a> - <a href="<?php echo URLADM ?>recover-password/index">Esqueceu a senha?</a></p>
=======
<p><a href="<?php echo URLADM ?>new-user/index">Cadastrar</a></p>

<p><a href="<?php echo URLADM ?>new-conf-email/index">Confirmar Email</a> - <a href="<?php echo URLADM ?>recover-password/index">Esqueceu a senha?</a></p>
>>>>>>> 1ebb21a97e10742749e7950cb5ef40e259103698




