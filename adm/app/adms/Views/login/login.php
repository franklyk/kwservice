<?php 
namespace App\adms\Views\login;

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    //Verifica se existe dados no formulário, se houver mantém os dados no INPUT
    if(isset($this->data['form'])){
        $valorForm = $this->data['form'];
    }
?>
<div class="container-login">
    <div class="wrapper-login">
        <div class="title">
            <span>Área Restrita</span>
        </div>
        <div class="msg-alert">
            <?php 
                if(isset($_SESSION['msg'])){
                    echo "<span id='msg'>". $_SESSION['msg'] ."</span>" ;
                    unset($_SESSION['msg']);
                }else{
                    echo "<span id='msg'></span>" ;
                }
            ?>
        </div>
        <form action="" method="post" id="form-login" class="form-login">

            <?php 
                //$user - mantém os dados na INPUT user
                $user = "";
                if(isset($valorForm['user'])){
                    $user = $valorForm['user'];}
            ?>
            <div class="row">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="user" id="user" placeholder="Digite o usuário" value="<?php echo $user ?>">
            </div>
            <?php 
                //$user - mantém os dados na INPUT password
                $password = "";
                if(isset($valorForm['password'])){
                    $password = $valorForm['password'];}
            ?>
            <div class="row">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Digite a Senha" autocomplete="on"
                    value="<?php echo $password ?>">
            </div>
            <div class="row button ">
                <button type="submit" name="SendLogin" value="Acessar"
                    class="btn btn-success button_center">Acessar</button>
            </div>
            <div class="signup-link">
                <a href="<?php echo URLADM; ?>new-user/index">Cadastrar</a> - <a
                    href="<?php echo URLADM; ?>recover-password/index">Esqueceu a Senha?</a>
            </div>
        </form>
        <!-- Usuário: franklin1@email.com<br>
        Senha: 123456a -->
    </div>
</div>