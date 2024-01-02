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
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Editar Senha</span>
            <div class="top-list-right">
                <?php 
                echo "<a href='" . URLADM . "list-users/index' class='btn-info'>Listar</a>";
                if(isset($valorForm['id'])){
                    echo "<a href='" . URLADM ."view-users/index/" . $valorForm['id'] . "' class='btn-primary'>Visualizar</a><br><br>";
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
            <form method="POST" action="" class="form-adm" id="form-edit-user">
                <?php 
                    $id = "";
                    if(isset($valorForm['id'])){
                        $id = $valorForm['id'];
                    }
                ?>
                <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                <div class="row-input">
                    <div class="column">
                        <?php
                        $password = '';
                        if(isset($valorForm['password'])){
                            $password = $valorForm['password'];
                        }
                        ?>
                        <label for="password" class="title-input">Nome:<span class="text-danger">*</span></label>
                        <input type="password" name="password" class="input-adm" id="password" placeholder="Digite a nova senha"
                            value="<?php echo $password ?>" required>
                    </div>
                    <div class="column btn-complete">
                        <button type="submit" name="SendEditUser" class="btn-warning " value="Salvar">Salvar</button>
                    </div>
                </div>
                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>
        </form>
    </div>
</div>
</div>