<?php

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");

}

if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}

if (isset($this->data['form'][0])) {
    $valorForm = $this->data['form'][0];
}
// var_dump($this->data['select']['sit']);
?>
<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Editar Configuração de Acesso</span>
            <div class="top-list-right">
                <?php 
                if (isset($valorForm['id'])) {
                    if($this->data['button']['view_levels_forms']){
                        echo "<a href='" . URLADM . "view-levels-forms/index/' class='btn-primary'>".ICON_VIEW." Visualizar</a> ";

                    }
                }
                ?>
            </div>
        </div>

        <div class="content-adm-alert">
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <span id="msg"></span>
        </div>

        <div class="content-adm">
            <form method="POST" action="" id="form-color" class="form-adm">
                <?php
                $id = "";
                if (isset($valorForm['id'])) {
                    $id = $valorForm['id'];
                }
                ?>
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

                <div class="row-input">
                    <div class="column">
                        <label class="title-input">Nível de Acesso:<span class="text-danger">*</span></label>
                        <select name="adms_access_level_id" id="adms_access_level_id" class="input-adm" required>
                        <option value="">Selecione</option>
                        <?php
                            foreach ($this->data['select']['lev'] as $lev) {
                                extract($lev);
                                if ((isset($valorForm['adms_access_level_id'])) and ($valorForm['adms_access_level_id'] == $lev_id)) {
                                    echo "<option value='$lev_id' selected>$name_lev</option>";
                                } else {
                                    echo "<option value='$lev_id'>$name_lev</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <label class="title-input">Situação:<span class="text-danger">*</span></label>
                        <select name="adms_sits_user_id" id="adms_sits_user_id" class="input-adm" required>
                        <option value="">Selecione</option>
                        <?php
                            foreach ($this->data['select']['sit'] as $lev) {
                                extract($lev);
                                if ((isset($valorForm['adms_sits_user_id'])) and ($valorForm['adms_sits_user_id'] == $sit_id)) {
                                    echo "<option value='$sit_id' selected>$name_sit</option>";
                                } else {
                                    echo "<option value='$sit_id'>$name_sit</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>

                <button type="submit" name="SendEditLevels" class="btn btn-warning" value="Salvar">Salvar</button>

            </form>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->