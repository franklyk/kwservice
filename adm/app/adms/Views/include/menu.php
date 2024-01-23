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