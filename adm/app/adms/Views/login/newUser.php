<?php 

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    //Verifica se existe dados no formulário, se houver mantém os dados no INPUT
    if(isset($this->data['form'])){
        var_dump($this->data['form']);

        $valorForm = $this->data['form'];
    }
?>
<div class="container-login">
    <div class="wrapper-login">

        <div class="title">
            <span>Novo Usuário</span>
        </div>
        <div class="msg-alert">
            <?php 
                if(isset($_SESSION['msg'])){
                    echo  $_SESSION['msg'] ;
                    unset($_SESSION['msg']);
                }
            ?>
            <span id='msg'></span>
        </div>
        <form method="POST" action="" id="form-new-user" class="form-login">

            <?php
            $name = "";
            if (isset($valorForm['name'])) {
                $name = $valorForm['name'];
            }
            ?>
            <div class="row">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="name" id="name" placeholder="Digite o nome" value="<?php echo $name; ?>"
                    >
            </div>

            <?php
            $email = "";
            if (isset($valorForm['email'])) {
                $email = $valorForm['email'];
            }
            ?>
            <div class="row">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Digite o e-mail" value="<?php echo $email; ?>"
                    >
            </div>

            <?php
            $password = "";
            if (isset($valorForm['password'])) {
                $password = $valorForm['password'];
            }
            ?>
            <div class="row">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Digite a senha"
                    onkeyup="passwordStrength()" value="<?php echo $password; ?>" >
            </div>

            <span id="msgViewStrength"></span>

            <div class="row button">
                <button type="submit" name="SendNewUser" value="Cadastrar" class="btn btn-success button_center">Cadastrar</button>
            </div>

            <div class="signup-link">
                <a href="<?php echo URLADM; ?>">Clique aqui</a> para acessar
            </div>

        </form>
    </div>
</div>