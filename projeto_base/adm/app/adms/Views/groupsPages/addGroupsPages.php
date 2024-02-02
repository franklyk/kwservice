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
            <span class="title-content">Cadastrar Grupos Páginas</span>
            <div class="top-list-right">
                <?php
                if($this->data['button']['list_groups_pages']){
                    echo "<a href='" . URLADM . "list-groups-pages/index' class='btn-info'>".ICON_LIST." Listar</a> ";
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
            <form method="POST" action="" id="form-groups-pages" class="form-adm">
                
                <div class="row-input">
                    <div class="column">
                        <?php
                        $name = "";
                        if (isset($valorForm['name'])) {
                            $name = $valorForm['name'];
                        }
                        ?>
                        <label class="title-input">Nome do Grupo:<span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="input-adm"
                            placeholder="Nome da Página a ser apresentado no menu" value="<?php echo $name; ?>"
                            required>
                    </div>
                </div>
                
                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>

                <button type="submit" name="SendAddGroupPages" class="btn btn-warning" value="cadastrar">Cadastrar</button>

            </form>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->