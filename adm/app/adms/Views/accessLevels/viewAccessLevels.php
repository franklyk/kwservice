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
            <span class="title-content">Detalhes do Nível de Acesso</span>
            <div class="top-list-right">
                <?php
                if($this->data['button']['list_access_levels']){
                    echo "<a href='" . URLADM . "list-access-levels/index' class='btn-info'>".ICON_LIST."Listar</a> ";
                }
                if (!empty($this->data['viewAccess'])) {
                    if($this->data['button']['edit_access_levels']){
                        echo "<a href='" . URLADM . "edit-access-levels/index/" . $this->data['viewAccess'][0]['id'] . "' class='btn-warning'>".ICON_EDIT." Editar</a> ";
                    }
                    if($this->data['button']['delete_access_levels']){
                        echo "<a href='" . URLADM . "delete-access-levels/index/" . $this->data['viewAccess'][0]['id'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este registro?\")' class='btn-danger'>".ICON_DELETE." Apagar</a> ";
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
            if (!empty($this->data['viewAccess'])) {
                extract($this->data['viewAccess'][0]);
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