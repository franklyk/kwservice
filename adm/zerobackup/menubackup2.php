<?php 


if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}

$sidebar_active = "";
if (isset($this->data['sidebarActive'])) {
    $sidebar_active = $this->data['sidebarActive'];
    // var_dump($this->data['sidebarActive']);
}
   


        
?>

<!-- Inicio Conteudo -->
<div class="content">
    <!-- Inicio da Sidebar -->
    <div class="sidebar">

        <?php 
        $dashboard = '';
        if($sidebar_active == 'dashboard'){
            $dashboard = 'active';
        }
        ?>
        <a href="<?php echo URLADM; ?>dashboard/index" class="sidebar-nav <?php echo $dashboard; ?>"><i
                class='icon fa-solid fa-house'></i><span>Dashboard</span></a>

        <?php 
            $list_users = '';
            if($sidebar_active == 'list-users'){
            $list_users = 'active';

            }
        ?>
        <a href="<?php echo URLADM; ?>list-users/index" class="sidebar-nav <?php echo $list_users; ?>"><i
                class='icon fa-solid fa-users'></i><span>Usuários</span></a>

        <?php 
            $list_sits_users = '';
            if($sidebar_active == 'list-sits-users'){
            $list_sits_users = 'active';

            }
        ?>
        <a href="<?php echo URLADM; ?>list-sits-users/index" class="sidebar-nav <?php echo $list_sits_users; ?>"><i
                class='icon fa-solid fa-user-check'></i><span>Situações dos Usuários</span></a>

        <?php 
            $list_access_levels = '';
            if($sidebar_active == 'list-access-levels'){
            $list_access_levels = 'active';

            }
        ?>
        <a href="<?php echo URLADM; ?>list-access-levels/index"
            class="sidebar-nav <?php echo $list_access_levels; ?>"><i
                class='icon fa-solid fa-user-check'></i><span>Nível de Acesso</span></a>



        <?php 
            $list_pages = '';
            if($sidebar_active == 'list-pages'){
            $list_pages = 'active';

            }
        ?>
        <a href="<?php echo URLADM; ?>list-pages/index" class="sidebar-nav <?php echo $list_pages; ?>"><i
                class='icon fa-solid fa-user-check'></i><span>Páginas</span></a>

        <?php $list_sits_pages = "";
        if ($sidebar_active == "list-sits-pages") {
            $list_sits_pages = "active";
        } 
        
        ?>

        <a href="<?php echo URLADM; ?>list-sits-pages/index" class="sidebar-nav <?php echo $list_sits_pages; ?>"><i
                class="icon fa-solid fa-file-circle-question"></i><span>Situações das Páginas</span></a>

        <?php $groups_pages = "";
        if ($sidebar_active == "list-groups-pages") {
            $groups_pages = "active";
        } ?>

        <a href="<?php echo URLADM; ?>list-groups-pages/index" class="sidebar-nav <?php echo $groups_pages; ?>"><i
                class="icon fa-solid fa-file-lines"></i></i><span>Grupos de Páginas</span></a>

        <?php $types_pages = "";
        if ($sidebar_active == "list-types-pages") {
            $types_pages = "active";
        } ?>

        <a href="<?php echo URLADM; ?>list-types-pages/index" class="sidebar-nav <?php echo $types_pages; ?>"><i
                class="icon fa-solid fa-file"></i><span>Tipos de Páginas</span></a>

        <?php 
        $list_colors = '';
        if($sidebar_active == 'list-colors'){
            $list_colors = 'active';

        }
        ?>
        <a href="<?php echo URLADM ?>list-colors/index" class="sidebar-nav <?php echo $list_colors; ?>"><i
                class="icon fa-solid fa-palette"></i><span>Cores</span></a>

        <?php 
        $list_conf_emails = '';
        if($sidebar_active == 'list-conf-emails'){
            $list_conf_emails = 'active';

        }
        ?>
        <a href="<?php echo URLADM; ?>list-conf-emails/index" class="sidebar-nav <?php echo $list_conf_emails; ?>"><i
                class="icon fa-solid fa-envelope"></i><span>Configurações de E-mail</span></a>



        <a href="<?php echo URLADM; ?>logout/index" class="sidebar-nav"><i
                class="icon fa-solid fa-arrow-right-from-bracket"></i><span>Sair</span></a>
            <?php 
            if((isset($this->data['menu'])) and ($this->data['menu'])){
                foreach($this->data['menu'] as $item_menu){
                    extract($item_menu);
                    $active_item_menu = '';
                    if($sidebar_active == $menu_controller){
                        $active_item_menu = 'active';
                    }
                    echo "<a href='" . URLADM . "$menu_controller/$menu_metodo' class='sidebar-nav $active_item_menu'><i
                       class='icon $icon'></i><span>$name_page</span></a>";
                }
            }
            
            ?>
            
    </div>
<!-- </div> -->
<!-- Fim da Sidebar -->