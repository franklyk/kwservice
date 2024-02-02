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
                if($this->data['button']['list_access_levels']){
                    echo "<a href='" . URLADM . "list-access-levels/index' class='btn btn-info'>".ICON_LIST." Listar Níveis de Acesso</a> ";
                }
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
                    <th class="list-head-content table-md-none">Ordem</th>
                    <th class="list-head-content table-md-none">Permissões</th>
                    <th class="list-head-content table-md-none">Menu</th>
                    <th class="list-head-content table-md-none">Dropdown</th>
                    <th class="list-head-content">Ações</th>
                </tr>
            </thead>
            <tbody class="list-body">
                <?php
                foreach ($this->data['listPermission'] as $Permission) {
                    extract($Permission);
                ?>
                <tr>
                    <td class="list-body-content">
                        <?php echo $id; ?>
                    </td>
                    <td class="list-body-content">
                        <?php echo $name_page; ?>
                    </td>
                    <td class="list-body-content table-md-none">
                        <?php  echo $order_level_page; ?>
                    </td>
                    <td class="list-body-content table-md-none">
                        <?php 
                            if($permission == 1){
                                echo "<a href='".URLADM."edit-permission/index/$id?&level=$adms_access_level_id&pag=".$this->data['pag']."'><span class='text-success'>Liberado</span></a>";
                            }else{
                                echo "<a href='".URLADM."edit-permission/index/$id?&level=$adms_access_level_id&pag=".$this->data['pag']."'><span class='text-danger'>Bloqueado</span></a>";
                            }

                        ?>
                    </td>
                    <td class="list-body-content table-md-none">
                        <?php 

                            if($print_menu == 1){
                                echo "<a href='".URLADM."edit-print-menu/index/$id?&level=$adms_access_level_id&pag=".$this->data['pag']."'><span class='text-success'>Liberado</span></a>";
                            }else{
                                echo "<a href='".URLADM."edit-print-menu/index/$id?&level=$adms_access_level_id&pag=".$this->data['pag']."'><span class='text-danger'>Bloqueado</span></a>";
                            }

                        ?>
                    <td class="list-body-content table-md-none">
                        <?php 

                            if($dropdown == 1){
                                echo "<a href='".URLADM."edit-dropdown-menu/index/$id?&level=$adms_access_level_id&pag=".$this->data['pag']."'><span class='text-success'>Sim</span></a>";
                            }else{
                                echo "<a href='".URLADM."edit-dropdown-menu/index/$id?&level=$adms_access_level_id&pag=".$this->data['pag']."'><span class='text-danger'>Não</span></a>";
                            }

                        ?>
                    </td>
                    <td class="list-body-content table-md-none">
                        <button onclick="actionDropdown(<?php echo $id; ?>)"
                            class="dropdown-btn-action"><?php echo ICON_SETTINGS ?> Ações</button>
                        <div id="actionDropdown<?php echo $id; ?>" class="dropdown-action-item">
                            <?php
                                if($this->data['button']['order_page_menu']){
                                    echo "<a href='" . URLADM . "order-page-menu/index/$id?&level=$adms_access_level_id&pag=".$this->data['pag']."'>". ICON_ORDER." Ordem</a>";

                                }
                                if($this->data['button']['edit_page_menu']){
                                    echo "<a href='" . URLADM . "edit-page-menu/index/$id?&level=$adms_access_level_id&pag=".$this->data['pag']."'>". ICON_EDIT." Editar</a>";

                                }
                            ?>
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