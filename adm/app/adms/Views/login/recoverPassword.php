<?php 
    //Verifica se existe dados no formulário, se houver mantém os dados no INPUT
    if(isset($this->data['form'])){
        $valorForm = $this->data['form'];
        // var_dump($this->data['form']);
    }
<<<<<<< HEAD

=======
    
    //Criptografar a senha
    //echo password_hash("123456a", PASSWORD_DEFAULT);
>>>>>>> 1ebb21a97e10742749e7950cb5ef40e259103698
?>

<h1>Recuperar senha</h1>
<?php 
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>
<span id="msg"></span>

<form action="" method="post" id="form-recover-pass">
    <?php 
    //$user - mantém os dados na INPUT user
        $email = "";
        if(isset($valorForm['email'])){
            $email = $valorForm['email'];
        }
    ?>
    <label for="">E-mail: </label><br>
    <input type="text" name="email" id="email" placeholder="Digite o seu e-mail" value="<?php echo $email ?>"> 

    <br><br>

<<<<<<< HEAD
    <button type="submit" name="SandRecoverPass" value="Enviar">Enviar</button>
=======
    <button type="submit" name="SandRecoverPass" value="Recuperar">Recuperar</button>
>>>>>>> 1ebb21a97e10742749e7950cb5ef40e259103698

</form>

<p><a href=" <?php echo URLADM; ?>">Clique aqui</a> para acessar</p>
