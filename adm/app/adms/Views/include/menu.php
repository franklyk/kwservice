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
<!-- Inicio da Sidebar -->
<div class="sidebar">
    <?php 
        if((isset($this->data['menu'])) and ($this->data['menu'])){
            foreach($this->data['menu'] as $item_menu){
                extract($item_menu);
                echo "<button class='dropdown-btn'>
                <i class='icon $icon_menu'></i><span>$menu_name</span><i class='fa-solid fa-caret-down'></i>
                </button>";
                echo "<div class='dropdown-container'>";
                if((isset($this->data['dropdown']) and ($this->data['dropdown']))){
                    foreach($this->data['dropdown'] as $item_dropdown){
                        extract($item_dropdown);
                        if($adms_items_menu_id == $menu_id){
                            if($dropdown == 1){

                                $active_item_menu = '';
                                if($sidebar_active == $menu_controller){
                                    $active_item_menu = 'active';
                                }
                                echo "<a href='" . URLADM . "$menu_controller/$menu_metodo' class='sidebar-nav $active_item_menu'><i
                                    class='icon $icon'></i><span>$name_page</span></a>";
                            }else{
                                echo "<a href='" . URLADM . "$menu_controller/$menu_metodo' class='sidebar-nav $active_item_menu'><i
                                class='icon $icon'></i><span>$name_page</span></a>";
                            }
                        }
                    }
                    echo "</div>";
                }else{
                    echo "<a href='" . URLADM . "$menu_controller/$menu_metodo' class='sidebar-nav $active_item_menu'><i
                    class='icon $icon'></i><span>$name_page</span></a>";
                }
            }
        }
        
        /*if((isset($this->data['menu'])) and ($this->data['menu'])){
            $count_drop_start = 0;
            $count_drop_end = 0;
            foreach($this->data['menu'] as $item_menu){
                extract($item_menu);

            $active_item_menu = '';
            if($sidebar_active == $menu_controller){
                $active_item_menu = 'active';
            }
            if($dropdown == 1) {
                $count_drop_end = $adms_items_menu_id;
                var_dump($count_drop_end);

                echo "<button class='dropdown-btn'>
                <i class='icon $icon_menu'></i><span>$name_menu</span><i class='fa-solid fa-caret-down'></i>
                </button>"; 
                if($adms_items_menu_id = $id_menu){
                    echo " <div class='dropdown-container'>";
                    echo "<a href='" . URLADM . "$menu_controller/$menu_metodo' class='sidebar-nav $active_item_menu'><i
                    class='icon $icon'></i><span>$name_page</span>
                    </a>";
                    echo "</div>";
                }
            


            } else {
            echo "<a href='" . URLADM . "$menu_controller/$menu_metodo' class='sidebar-nav $active_item_menu'><i
            class='icon $icon'></i><span>$name_page</span>
            </a>";
            }
        }
        }*/
        
    ?>
</div>
<!-- Fim da Sidebar -->