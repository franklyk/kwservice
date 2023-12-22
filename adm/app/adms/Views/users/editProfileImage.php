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

echo "<a href='".URLADM."view-profile/index'>Perfil</a><br><br>";





    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>
<span id="msg"></span>

<form action="" method="post" id="form-edit-prof-img" enctype="multipart/form-data">


    <label for="new_image"><strong>Imagem<span style="color:#f00;">*</span> 300x300:</strong> </label>
    <input type="file" name="new_image" id="new_image" onchange="inputFileValImg()" required> <br><br>
    <?php 
        if((!empty($valorForm['image'])) and (file_exists("app/adms/assets/images/users/" . $_SESSION['user_id'] ."/" . $valorForm['image']))){
            $old_image = URLADM . "app/adms/assets/images/users/" . $_SESSION['user_id'] . "/" . $valorForm['image'];
        }else{
            $old_image = URLADM . "app/adms/assets/images/users/usuário.png";
        }
    ?>
    <span id="preview-img">
        <img src="<?php echo $old_image ?>" alt="imagem" style="width: 100px; height: 100px;">
    </span>
    <br><br>



    <span style="color:#f00;"><strong>* Campo Obrigatório!</strong></span> <br><br>

    <button type="submit" name="SendEditProfImage" value="Salvar"><strong>Salvar</strong></button>

</form>