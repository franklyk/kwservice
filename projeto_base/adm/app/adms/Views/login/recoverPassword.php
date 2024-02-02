<?php 

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
    //Verifica se existe dados no formulário, se houver mantém os dados no INPUT


    if (isset($this->data['form'])) {
        $valorForm = $this->data['form'];
    }
    
    ?>

<div class="container-login">
    <div class="wrapper-login">

        <div class="title">
            <span>Recuperar Senha</span>
        </div>

        <div class="msg-alert">
            <?php
                if (isset($_SESSION['msg'])) {
                    echo "<span id='msg'> " . $_SESSION['msg'] . "</span>";
                    unset($_SESSION['msg']);
                } else {
                    echo "<span id='msg'></span>";
                }
                ?>

        </div>

        <form method="POST" action="" id="form-recover-pass" class="form-login">

            <?php
                $email = "";
                if (isset($valorForm['email'])) {
                    $email = $valorForm['email'];
                }
                ?>
            <div class="row">
                <i class="fa-solid fa-envelope"></i>
                <input type="text" name="email" id="email" placeholder="Digite o seu e-mail"
                    value="<?php echo $email; ?>" required>
            </div>

            <div class="row button">
                <button type="submit" name="SendRecoverPass" value="Recuperar" class="btn btn-success button_center">Recuperar</button>
            </div>

            <div class="signup-link">
                <a href="<?php echo URLADM; ?>">Clique aqui</a> para acessar
            </div>

        </form>
    </div>
</div>