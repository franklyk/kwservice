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
                if($this->data['button']['edit_levels_forms']){
                    echo "<a href='" . URLADM . "edit-levels-forms/index' class='btn-info'>".ICON_EDIT." Editar</a> ";
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
                if (!empty($this->data['viewLevelsForm'])) {
                    extract($this->data['viewLevelsForm'][0]);
                }
            ?>

                <div class="view-det-adm">
                    <span class="view-adm-title">ID: </span>
                    <span class="view-adm-info"><?php echo $id; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Name: </span>
                    <span class="view-adm-info"><?php echo $name_access; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Situação:</span>
                    <span class="view-adm-info" <?php echo "style='color:$color'" ?>><?php echo $name_sit?></span>
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
                            } 
                        ?>
                    </span>
                </div>
            <?php
            
            ?>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->