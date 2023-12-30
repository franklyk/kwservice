<?php 

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
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

<h1>Editar Senha Do E-mail de Configuaração</h1>


<?php 
echo "<a href='".URLADM."list-conf-emails/index'>Listar</a><br>";
if(isset($valorForm['id'])){
    echo "<a href='".URLADM."view-conf-emails/index/" . $valorForm['id'] . "'>Visualizar</a><br><br>";
}


    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>
<span id="msg"></span>

<form action="" method="post" id="form-edit-conf-email-pass">

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
        $password = "";
        if(isset($valorForm['password'])){
            $password = $valorForm['password'];
        }
    ?>
    <label for="password"><strong>Senha:</strong> <span style="color:#f00;">*</span> </label><br>
    <input type="password" name="password" id="password" placeholder="Digite a nova senha" onkeyup="passwordStrength()"
        autocomplete="on" value="<?php echo $password ?>" > 

    <span id="msgViewStrength"><br><br></span>

    <span style="color:#f00;"><strong>* Campo Obrigatório!</strong></span> <br><br>

    <button type="submit" name="SendEditConfEmailsPass" value="Salvar"><strong>Salvar</strong></button>

</form>