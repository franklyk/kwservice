<?php

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");

}

if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}
?>
<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Cadastrar Tipos de Páginas</span>
            <div class="top-list-right">
                <?php
                if($this->data['button']['list_types_pages']){
                    echo "<a href='" . URLADM . "list-types-pages/index' class='btn-info'>".ICON_LIST." Listar</a> ";

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
            <form method="POST" action="" id="form-add-types-pages" class="form-adm">
                
                <div class="row-input">
                    <div class="column">
                        <?php
                        $type = "";
                        if (isset($valorForm['type'])) {
                            $type = $valorForm['type'];
                        }
                        ?>
                        <label class="title-input">Tipo:<span class="text-danger">*</span></label>
                        <input type="text" name="type" id="type" class="input-adm"
                            placeholder="Nome do Tipo de Página" value="<?php echo $type; ?>"
                            required>
                    </div>
                </div>
                <div class="row-input">
                    <div class="column">
                        <?php
                        $name = "";
                        if (isset($valorForm['name'])) {
                            $name = $valorForm['name'];
                        }
                        ?>
                        <label class="title-input">Nome do Tipo:<span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="input-adm"
                            placeholder="Nome do Tipo de Página" value="<?php echo $name; ?>"
                            required>
                    </div>
                </div>
                <div class="row-input">
                    <div class="column">
                        <?php
                        $obs = "";
                        if (isset($valorForm['obs'])) {
                            $obs = $valorForm['obs'];
                        }
                        ?>
                        <label class="title-input">Observações:</label>
                        <input type="text" name="obs" id="obs" class="input-adm"
                            placeholder="Observações" value="<?php echo $obs; ?>"
                            >
                    </div>
                </div>
                
                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>

                <button type="submit" name="SendAddTypesPages" class="btn btn-warning" value="cadastrar">Cadastrar</button>

            </form>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->