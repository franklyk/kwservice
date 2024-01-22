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
    <div class="row">
        <div class="top-list">
            <span class="title-content">Editar Tipos de Páginas</span>
            <div class="top-list-right">
                <?php
                if($this->data['button']['list_types_pages']){}
                echo "<a href='" . URLADM . "list-types-pages/index' class='btn-info'>".ICON_LIST." Listar</a> ";
                if (isset($valorForm['id'])) {
                    if($this->data['button']['view_types_pages']){}
                    echo "<a href='" . URLADM . "view-types-pages/index/" . $valorForm['id'] . "' class='btn-primary'>".ICON_VIEW." Visualizar</a> ";
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
            <form method="POST" action="" id="form-edit-types-pages" class="form-adm">
                <?php
                $id = "";
                if (isset($valorForm['id'])) {
                    $id = $valorForm['id'];
                }
                ?>
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

                <div class="row-input">
                    <div class="column">
                        <?php
                        $type = "";
                        if (isset($valorForm['type'])) {
                            $type = $valorForm['type'];
                        }
                        ?>
                        <label class="title-input">Nome do Grupo:<span class="text-danger">*</span></label>
                        <input type="text" name="type" id="type" class="input-adm" placeholder="Nome do grupo" value="<?php echo $type; ?>" required>
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
                        <label class="title-input">Nome do Grupo:<span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="input-adm" placeholder="Nome do grupo" value="<?php echo $name; ?>" required>
                    </div>
                </div>

                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>

                <button type="submit" name="SendEditType" class="btn btn-warning" value="Salvar">Salvar</button>

            </form>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->