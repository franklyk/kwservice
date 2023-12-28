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

<h1>Editar Cores</h1>


<?php 
echo "<a href='".URLADM."list-colors/index'>Listar</a><br>";
if(isset($valorForm['id'])){
    echo "<a href='".URLADM."view-colors/index/" . $valorForm['id'] . "'>Visualizar</a><br><br>";
}


    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>
<span id="msg"></span>

<form action="" method="post" id="form-color">

    <?php 
    //$user - mantém os dados na INPUT id
        $id = "";
        if(isset($valorForm['id'])){
            $id = $valorForm['id'];
        }
    ?>
    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">

    <?php 
    //$user - mantém os dados na INPUT name
        $name = "";
        if(isset($valorForm['name'])){
            $name = $valorForm['name'];
        }
    ?>
    <label for="name"><strong>Nome:</strong> <span style="color:#f00;">*</span> </label><br>
    <input type="text" name="name" id="name" placeholder="Digite o nome completo" autocomplete="on"
        value="<?php echo $name ?>"> <br><br>

    <?php 
    //$user - mantém os dados na INPUT color
        $color = "";
        if(isset($valorForm['color'])){
            $color = $valorForm['color'];
        }
    ?>
    <label for="color"><strong>Cor:</strong> <span style="color:#f00;">*</span> </label><br>
    <input type="text" name="color" id="color" placeholder="Digite o nome completo" autocomplete="on"
        value="<?php echo $color ?>"> <br><br>


    <span style="color:#f00;"><strong>* Campo Obrigatório!</strong></span> <br><br>

    <button type="submit" name="SendEditColor" value="Salvar"><strong>Salvar</strong></button>

</form>