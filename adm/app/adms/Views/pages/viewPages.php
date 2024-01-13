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
            <span class="title-content">Detalhes da Página</span>
            <div class="top-list-right">
                <?php
                echo "<a href='" . URLADM . "list-pages/index' class='btn-info'>".ICON_LIST." Listar</a> ";
                if (!empty($this->data['viewPages'])) {
                    echo "<a href='" . URLADM . "edit-pages/index/" . $this->data['viewPages'][0]['id'] . "' class='btn-warning'>".ICON_EDIT." Editar</a>";
                    echo "<a href='" . URLADM . "delete-pages/index/" . $this->data['viewPages'][0]['id'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este registro?\")' class='btn-danger'>".ICON_DELETE." Apagar</a>";
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
            if (!empty($this->data['viewPages'])) {
                extract($this->data['viewPages'][0]);
            ?>

            <div class="view-det-adm">
                <span class="view-adm-title">ID: </span>
                <span class="view-adm-info"><?php echo $id; ?></span>
            </div>

            <div class="view-det-adm">
                <span class="view-adm-title">Nome: </span>
                <span class="view-adm-info"><?php echo $name_page; ?></span>
            </div>
            
            <div class="view-det-adm">
                <span class="view-adm-title">Classe: </span>
                <span class="view-adm-info"><?php echo $controller; ?></span>
            </div>
            <div class="view-det-adm">
                <span class="view-adm-title">Método: </span>
                <span class="view-adm-info"><?php echo $metodo; ?></span>
            </div>
            <div class="view-det-adm">
                <span class="view-adm-title">Classe no Menu: </span>
                <span class="view-adm-info"><?php echo $menu_controller; ?></span>
            </div>
            <div class="view-det-adm">
                <span class="view-adm-title">Método no Menu: </span>
                <span class="view-adm-info"><?php echo $menu_metodo; ?></span>
            </div>
            
            <div class="view-det-adm">
                <span class="view-adm-title">Página Pública: </span>
                <span class="view-adm-info">
                    <?php 
                        if($publish === 1){
                            echo "Sim";
                        }else{
                            echo "Não";
                        }
                        
                    ?>
                </span>
            </div>
            <div class="view-det-adm">
                <span class="view-adm-title">Ícone: </span>
                <span class="view-adm-info">
                    <?php 
                        if(!empty($icon)){
                            echo "<i class='$icon'></i> ". $icon;
                        }  
                    ?>
                </span>
            </div>
            <div class="view-det-adm">
                <span class="view-adm-title">Observação: </span>
                <span class="view-adm-info">
                    <?php 
                        if(!empty($obs)){
                            echo $obs;
                        }  
                    ?>
                </span>
            </div>
            <div class="view-det-adm">
                <span class="view-adm-title">Situação da Página: </span>
                <span class="view-adm-info" style="color:<?php echo $color ?>;"><?php echo $name_sit; ?></span>
            </div>
            <div class="view-det-adm">
                <span class="view-adm-title">Tipo da Página: </span>
                <span class="view-adm-info"><?php echo $name_type; ?></span>
            </div>
            <div class="view-det-adm">
                <span class="view-adm-title">Grupo da Página: </span>
                <span class="view-adm-info"><?php echo $name_grpg; ?></span>
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