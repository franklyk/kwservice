<?php 


if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}

?>

<!-- <a href="">Dashboard</a><br>
<a href="<?php echo URLADM; ?>list-users/index">Usuarios</a><br>
<a href="<?php echo URLADM; ?>list-sits-users/index">Situações dos Usuários</a><br>
<a href="<?php echo URLADM; ?>list-colors/index">Cores</a><br>
<a href="<?php echo URLADM; ?>list-conf-emails/index">Configurações de Email</a><br>
<a href="<?php echo URLADM; ?>view-profile/index">Perfil</a><br>

<a href="<?php echo URLADM; ?>logout/index">Sair</a><br> -->
<?php 
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
        $dashboard = "";
        if ($sidebar_active == "dashboard") {
            $dashboard = "active";
        } ?>
        <a href="<?php echo URLADM; ?>dashboard/index" class="sidebar-nav <?php echo $dashboard; ?>"><i
                class="icon fa-solid fa-house"></i><span>Dashboard</span></a>

        <?php
        $sidebar_user = '';
        $list_users = '';
        if($sidebar_active == 'list-users'){
            $list_users = 'active';
            $sidebar_user = 'active';
        }
        
        ?>
        <?php 
        $list_sits_users = '';
        if($sidebar_active == 'list-sits-users'){
            $list_sits_users = 'active';
            $sidebar_user = 'active';

        }
        ?>

        <button class="dropdown-btn" <?php echo $sidebar_user; ?>>
            <i class="icon fa-solid fa-users"></i><span>Usuário</span><i class="fa-solid fa-caret-down"></i>
        </button>
        <div class="dropdown-container <?php echo $sidebar_user; ?>">
            <a href="<?php echo URLADM; ?>list-users/index" class="sidebar-nav <?php echo $sidebar_user; ?>"><i
                    class="icon fa-solid fa-user-check"></i><span>Usuários</span></a>

            <a href="<?php echo URLADM; ?>list-sits-users/index" class="sidebar-nav"><i
                    class="icon fa-solid fa-user-gear"></i><span>Situações do Usuario
                </span></a>
        </div>
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
            $list_colors = 'active';

        }
        ?>
        <a href="<?php echo URLADM; ?>list-conf-emails/index" class="sidebar-nav <?php echo $list_conf_emails; ?>"><i
                class="icon fa-solid fa-envelope"></i><span>Configurações de E-mail</span></a>



        <a href="<?php echo URLADM; ?>logout/index" class="sidebar-nav"><i
                class="icon fa-solid fa-arrow-right-from-bracket"></i><span>Sair</span></a>

    </div>
    <!-- Fim da Sidebar -->
