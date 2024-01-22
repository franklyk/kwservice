<?php 

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}
if(isset($this->data['form'])){
    $valorForm = $this->data['form'];
}
if(isset($this->data['form'][0])){
    $valorForm = $this->data['form'][0];
}
?>
<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Editar Perfil</span>
            <div class="top-list-right">
                <?php 
                if($this->data['button']['view_profile']){
                    echo "<a href='" . URLADM . "view-profile/index' class='btn-info'>".ICON_VIEW." Perfil</a> ";

                }
            ?>

            </div>
        </div>
        <div class="content-adm-alert">
            <?php 
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        } 
        ?>
            <span id="msg"></span>
        </div>
        <div class="content-adm">
            <form method="POST" action="" class="form-adm" id="form-edit-profile">

                <div class="row-input">
                    <div class="column">
                        <?php
                            $name = '';
                            if(isset($valorForm['name'])){
                                $name = $valorForm['name'];
                            }
                        ?>
                        <label for="name" class="title-input">Nome:<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="input-adm" id="name" placeholder="Digite o nome completo"
                            value="<?php echo $name ?>" required>
                    </div>
                    <div class="column">
                        <?php
                            $nickname = "";
                            if (isset($valorForm['nickname'])) {
                                $nickname = $valorForm['nickname'];
                            }
                        ?>
                        <label class="title-input">Apelido:</label>
                        <input type="text" name="nickname" id="nickname" class="input-adm"
                            placeholder="Digite o apelido" value="<?php echo $nickname; ?>">
                    </div>
                </div>
                <div class="row-input">
                    <div class="column">
                        <?php
                            $user = '';
                            if(isset($valorForm['user'])){
                                $user = $valorForm['user'];
                            }
                        ?>
                        <label for="user" class="title-input">Usuário:<span class="text-danger">*</span></label>
                        <input type="text" name="user" class="input-adm" id="user" placeholder="Digite o usuario"
                            value="<?php echo $user ?>" required>
                    </div>
                    <div class="column">
                        <?php
                            $email = '';
                            if(isset($valorForm['email'])){
                                $email = $valorForm['email'];
                            }
                        ?>
                        <label for="email" class="title-input">E-mail:<span class="text-danger">*</span></label>
                        <input type="email" name="email" class="input-adm" id="email"
                            placeholder="Digite o seu melhor e-mail" value="<?php echo $email ?>" required>
                    </div>
                </div>
                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>

                <div class="column btn-complete">
                    <button type="submit" name="SendEditUser" class="btn btn-warning " value="Salvar">Salvar</button>
                </div>
                
            </form>
        </div>
    </div>
</div>