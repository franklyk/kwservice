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

//    var_dump($_SESSION['loger']);
?>



<!-- Inicio Conteudo -->
<div class="content">
    <!-- Inicio da Sidebar -->
    <div class="sidebar">
        <?php
            $active = '';
            if($sidebar_active == 'dashboard'){
                $active = 'active';
            }
            echo "<a href='" . URLADM . "dashboard/index' class='sidebar-nav $active'><i
            class='icon fa-solid fa-house'></i><span>Dashboard</span></a>";
                // var_dump($_SESSION['loger']);
                if(isset($_SESSION['loger'])){
                    
                    
                    foreach($_SESSION['loger'] as $loger){
                        extract($loger);
                        // var_dump($loger);
                        $active = '';
                        if($sidebar_active == $menu_controller){
                            $active = 'active';
                        }
                        echo "<a href='".URLADM. "{$menu_controller}/index' class='sidebar-nav $active'><i
                        class='icon $icon'></i><span>$name_page</span></a>";
                    }
                }else{
                    echo "";
                }
            echo "<a href='" . URLADM . "logout/index' class='sidebar-nav'><i class='icon fa-solid fa-arrow-right-from-bracket'></i><span>Sair</span></a>";

        ?>



    </div>
<!-- </div> -->
<!-- Fim da Sidebar -->