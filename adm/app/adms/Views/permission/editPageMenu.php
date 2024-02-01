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

?>
<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <!-- <div class="row"> -->
        <div class="top-list">
            <span class="title-content">Editar Ítem de Menu da Página</span>
            <div class="top-list-right">
                <?php
                if($this->data['button']['list_permission']){
                    echo "<a href='" . URLADM . "list-permission/index?level={$this->data['btnLevel']}' class='btn-info'>".ICON_LIST." Listar</a> ";
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
            <form method="POST" action="" id="form-edit-page-menu" class="form-adm">
                <?php
                $id = "";
                if (isset($valorForm['id'])) {
                    $id = $valorForm['id'];
                }
                ?>
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

                <?php
                $name_page = "";
                if (isset($valorForm['name_page'])) {
                    $name_page = $valorForm['name_page'];
                }
                ?>
                <div class="view-det-adm">
                    <span class="view-adm-title">Página: </span>
                    <span class="view-adm-info"><?php echo $name_page; ?></span>
                </div>

                <div class="row-input">
                    <div class="column">
                        <label class="title-input">Item de Menu:<span class="text-danger">*</span></label>
                        <select name="adms_items_menu_id" id="adms_items_menu_id" class="input-adm" required>
                            <option value="">Selecione</option>
                            <?php
                            foreach ($this->data['select']['itm'] as $menu_itm) {
                                extract($menu_itm);
                                // var_dump($menu_itm);
                                if (isset($valorForm['adms_items_menu_id']) and $valorForm['adms_items_menu_id'] == $id_menu) {
                                    echo "<option value='$id_menu' selected>$name_menu</option>";
                                } else {
                                    echo "<option value='$id_menu'>$name_menu</option>";
                                }

                            }
                            ?>
                        </select>
                    </div>
                </div>

                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>

                <button type="submit" name="SendEditPageMenu" class="btn btn-warning" value="Salvar">Salvar</button>

            </form>
        </div>
    <!-- </div> -->
</div>
<!-- Fim do conteudo do administrativo -->