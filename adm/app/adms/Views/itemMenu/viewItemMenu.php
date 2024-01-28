<?php 

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    
    }
?>
<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Detalhes do Ítem de Menu</span>
            <div class="top-list-right">
                <?php
                if($this->data['button']['list_item_menu']){
                    echo "<a href='" . URLADM . "list-item-menu/index' class='btn-info'>".ICON_LIST." Listar</a> ";
                }
                if (!empty($this->data['viewItemMenu'])) {
                    if($this->data['button']['edit_item_menu']){
                        echo "<a href='" . URLADM . "edit-item-menu/index/" . $this->data['viewItemMenu'][0]['id'] . "' class='btn-warning'>".ICON_EDIT." Editar</a> ";
                    }
                    if($this->data['button']['delete_item_menu']){
                        echo "<a href='" . URLADM . "delete-item-menu/index/" . $this->data['viewItemMenu'][0]['id'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este registro?\")' class='btn-danger'>".ICON_DELETE." Apagar</a> ";
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
        </div>

        <div class="content-adm">
            <?php
            if (!empty($this->data['viewItemMenu'])) {
                extract($this->data['viewItemMenu'][0]);
            ?>

                <div class="view-det-adm">
                    <span class="view-adm-title">ID: </span>
                    <span class="view-adm-info"><?php echo $id; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Nome: </span>
                    <span class="view-adm-info"><?php echo $name; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Ícone: </span>
                    <span class="view-adm-info"><?php echo "<span <i class='icon $icon'></i> $icon</span>"; ?></span>
                </div>
                
                <div class="view-det-adm">
                    <span class="view-adm-title">Ordem: </span>
                    <span class="view-adm-info"><?php echo "$order_item_menu"; ?></span>
                </div>
                
                <div class="view-det-adm">
                    <span class="view-adm-title">Cadastrado: </span>
                    <span class="view-adm-info"><?php echo date('d/m/Y H:i:s', strtotime($created)); ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Editado: </span>
                    <span class="view-adm-info">
                        <?php
                        if (!empty($modified)) {
                            echo date('d/m/Y H:i:s', strtotime($modified));
                        } ?>
                    </span>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->