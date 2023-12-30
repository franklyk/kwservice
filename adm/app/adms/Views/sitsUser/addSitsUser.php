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
    
    //Criptografar a senha
    //echo password_hash("123456a", PASSWORD_DEFAULT);
?>

<h1>Cadastrar Situação</h1>



<?php
    echo "<a href='".URLADM."list-sits-users/index'>Listar</a><br><br>";
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>
<span id="msg"></span>

<form action="" method="post" id="form-sit-user">
    <?php 
    //$user - mantém os dados na INPUT user
        $name = "";
        if(isset($valorForm['name'])){
            $name = $valorForm['name'];
        }
    ?>
    <label for="name"><strong>Nome:</strong> <span style="color:#f00;">*</span> </label><br>
    <input type="text" name="name" id="name" placeholder="Digite o nome completo" autocomplete="on"
        value="<?php echo $name ?>"> <br><br>

    <label for="adms_color_id"><strong>Cor:</strong> <span style="color:#f00;">*</span> </label><br>
    <select name="adms_color_id" id="adms_color_id">
        <option value="">Selecione</option>
        <?php 
        foreach($this->data['select']['col'] as $col){
            extract($col);
            if((isset($valorForm['adms_color_id']))and ($valorForm['adms_color_id'] == $id_col)){
                echo "<option value='$id_col' selected>$name_col</option>";
            }else{
                echo "<option value='$id_col'>$name_col</option>";
            }
        }
        ?>
    </select><br><br>

    <span style="color:#f00;"><strong>* Campo Obrigatório!</strong></span> <br><br>

    <button type="submit" name="SendAddSitUser" value="Cadastrar"><strong>Cadastrar</strong></button>

</form>