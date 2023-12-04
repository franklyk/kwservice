<?php
//Verifica se existe dados no formulário, se houver mantém os dados no INPUT
if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}

?>

<h1>Nova Senha</h1>
<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}


?>

<span id="msg"></span>

<form action="" method="post" id="form-update-pass">
    <?php
    //$password - mantém os dados na INPUT password
    $password = "";
    if (!empty($valorForm['password'])) {
        $password = $valorForm['password'];
    }
    ?>
    <label for="">Senha</label><br>
    <input type="text" name="password" id="password" placeholder="Digite a Senha" autocomplete="off" onkeyup="passwordStrength()" value="<?php echo $password ?>" required>
    <br><br>


    <button type="submit" name="SandUpPass" id="SandUpPass" value="Salvar">Salvar</button>
</form>

<p><a href=" <?php echo URLADM ?>">Clique aqui</a> para acessar</p>
