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

<h1>Editar Imagem</h1>


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

<form action="" method="post" id="form-edit-user" enctype="multipart/form-data">

    <?php 
    //$user - mantém os dados na INPUT user
        $id = "";
        if(isset($valorForm['id'])){
            $id = $valorForm['id'];
        }
    ?>
    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">

    <label for="image"><strong>Imagem<span style="color:#f00;">*</span>  300x300:</strong> </label>
    <input type="file" name="new_image" id="new_image"> <br><br>

    
    <span style="color:#f00;"><strong>* Campo Obrigatório!</strong></span> <br><br>

    <button type="submit" name="SendEditUserImage" value="Salvar"><strong>Salvar</strong></button>

</form>