<?php
    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
 ?>
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Listar Permissões do Nível de Acesso
                <?php echo $this->data['viewAccessLevels'][0]['name']; ?></span>
            <div class="top-list-right">
                <?php
                echo "<a href='" .URLADM . "list-permission/index' class='btn-info'>Listar Nível de Acesso</a>";
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
        </div>
        <table class="table-list">
            <thead class="list-head">
                <tr>
                    <th class="list-head-content">ID</th>
                    <th class="list-head-content">Página</th>
                    <th class="list-head-content table-sm-none">Ordem</th>
                    <th class="list-head-content">Permissões</th>
                    <th class="list-head-content"><?php echo ICON_SETTINGS ?> Ações</th>
                </tr>
            </thead>
            <tbody class="list-body">
                <?php
                foreach ($this->data['listPermission'] as $Permission) {
                    extract($Permission);
                ?>
                <tr>
                    <td class="list-body-content"><?php echo $id; ?></td>
                    <td class="list-body-content"><?php echo $name_page; ?></td>
                    <td class="list-body-content"><?php echo $order_level_page; ?></td>
                    <td class="list-body-content"><?php echo $permission; ?></td>

                    <td class="list-body-content">
                        <div class="dropdown-action">
                            <button onclick="actionDropdown(<?php echo $id; ?>)"
                                class="dropdown-btn-action"><?php echo ICON_SETTINGS ?> Ações</button>
                            <div id="actionDropdown<?php echo $id; ?>" class="dropdown-action-item">
                                <?php
                                   echo "<a href='" . URLADM . "order-access-levels/index/$id?pag=" . $this->data['pag'] . "'>". ICON_ORDER." Ordem</a>";
                                        
                                    echo "<a href='" . URLADM . "list-permission/index?level=$id'>". ICON_PERMISSION." Permissão</a>";
                                    echo "<a href='" . URLADM . "view-access-levels/index/$id'>". ICON_VIEW." Visualizar</a>";
                                    echo "<a href='" . URLADM . "edit-access-levels/index/$id'>". ICON_EDIT." Editar</a>";
                                    echo "<a href='" . URLADM . "delete-access-levels/index/$id' onclick='return confirm(\"Tem certeza que deseja excuir este Registro?\")'>". ICON_DELETE." Apagar</a>";
                                ?>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        
        <?php 
            echo $this->data['pagination']; 
        ?>
    </div>
</div>