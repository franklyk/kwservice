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

<form action="" method="post" id="form-edit-user-image" enctype="multipart/form-data">

    <?php 
    //$user - mantém os dados na INPUT user
        $id = "";
        if(isset($valorForm['id'])){
            $id = $valorForm['id'];
        }
    ?>
    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">

    <label for="image"><strong>Imagem<span style="color:#f00;">*</span>  300x300:</strong> </label>
    <input type="file" name="new_image" id="new_image" onchange="inputFileValImg()" required> <br><br>
    <?php 
        if((!empty($valorForm['image'])) and (file_exists("app/adms/assets/images/users/" . $valorForm['id'] ."/" . $valorForm['image']))){
            $old_image = URLADM . "app/adms/assets/images/users/" . $valorForm['id'] . "/" . $valorForm['image'];
        }else{
            $old_image = URLADM . "app/adms/assets/images/users/usuário.png";
        }
    ?>
    <span id="preview-img">
        <img src="<?php echo $old_image ?>" alt="imagem" style="width: 100px; height: 100px;">
    </span>
    <br><br>

    
    <span style="color:#f00;"><strong>* Campo Obrigatório!</strong></span> <br><br>

    <button type="submit" name="SendEditUserImage" value="Salvar"><strong>Salvar</strong></button>

</form>