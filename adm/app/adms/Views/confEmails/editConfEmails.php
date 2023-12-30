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

<h1>Editar Configurações de E-mail</h1>


<?php 
echo "<a href='".URLADM."list-conf-emails/index'>Listar</a><br>";
if(isset($valorForm['id'])){
    echo "<a href='".URLADM."view-conf-emails/index/" . $valorForm['id'] . "'>Visualizar</a><br>";
    echo "<a href='" . URLADM . "edit-conf-emails-password/index/" . $valorForm['id'] . "'>Editar Senha</a><br><br>";
}


    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>
<span id="msg"></span>

<form action="" method="post" id="form-edit-conf-emails">

    <?php 
    //$user - mantém os dados na INPUT id
        $id = "";
        if(isset($valorForm['id'])){
            $id = $valorForm['id'];
        }
    ?>
    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">

    <?php 
    //$user - mantém os dados na INPUT Título
        $title = "";
        if(isset($valorForm['title'])){
            $title = $valorForm['title'];
        }
    ?>
    <label for="title"><strong>Título:</strong> <span style="color:#f00;">*</span> </label><br>
    <input type="text" name="title" id="title" placeholder="Título para idetificar o e-mail" autocomplete="on"
        value="<?php echo $title ?>"> <br><br>
    <?php 
    //$user - mantém os dados na INPUT Nome
        $name = "";
        if(isset($valorForm['name'])){
            $name = $valorForm['name'];
        }
    ?>
    <label for="name"><strong>Nome:</strong> <span style="color:#f00;">*</span> </label><br>
    <input type="text" name="name" id="name" placeholder="Nome que será apresentado no remetente" autocomplete="on"
        value="<?php echo $name ?>"> <br><br>
    <?php 
    //$user - mantém os dados na INPUT E-mail
        $email = "";
        if(isset($valorForm['email'])){
            $email = $valorForm['email'];
        }
    ?>
    <label for="email"><strong>E-mail:</strong> <span style="color:#f00;">*</span> </label><br>
    <input type="text" name="email" id="email" placeholder="E-mail que será apresentado no remetente" autocomplete="on"
        value="<?php echo $email ?>"> <br><br>
    <?php 
    //$user - mantém os dados na INPUT Host
        $host = "";
        if(isset($valorForm['host'])){
            $host = $valorForm['host'];
        }
    ?>
    <label for="host"><strong>Host:</strong> <span style="color:#f00;">*</span> </label><br>
    <input type="text" name="host" id="host" placeholder="Servidor utilizado para enviar o e-mail" autocomplete="on"
        value="<?php echo $host ?>"> <br><br>
    <?php 
    //$user - mantém os dados na INPUT Usuário
        $username = "";
        if(isset($valorForm['username'])){
            $username = $valorForm['username'];
        }
    ?>
    <label for="username"><strong>Usuário:</strong> <span style="color:#f00;">*</span> </label><br>
    <input type="text" name="username" id="username"
        placeholder="Usuário do e-mail, na maioria dos casos é o próprio e-mail" autocomplete="on"
        value="<?php echo $username ?>"> <br><br>


    <?php 
    //$user - mantém os dados na INPUT SMTP
        $smtpsecure = "";
        if(isset($valorForm['smtpsecure'])){
            $smtpsecure = $valorForm['smtpsecure'];
        }
    ?>
    <label for="smtpsecure"><strong>SMTP:</strong> <span style="color:#f00;">*</span> </label><br>
    <input type="text" name="smtpsecure" id="smtpsecure" placeholder="SMTP" autocomplete="on"
        value="<?php echo $smtpsecure ?>"> <br><br>
    <?php 
    //$user - mantém os dados na INPUT Porta
        $port = "";
        if(isset($valorForm['port'])){
            $port = $valorForm['port'];
        }
    ?>
    <label for="port"><strong>Porta:</strong> <span style="color:#f00;">*</span> </label><br>
    <input type="text" name="port" id="port" placeholder="Porta" autocomplete="on" value="<?php echo $port ?>"> <br><br>



    <span style="color:#f00;"><strong>* Campo Obrigatório!</strong></span> <br><br>

    <button type="submit" name="SendEditConfEmail" value="Salvar"><strong>Salvar</strong></button>

</form>