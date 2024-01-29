<?php

namespace App\adms\Models\helper;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}
/**
 * Classe 
 *
 * @author FRANKLIN <frsbatist@gmail.com>
 */
class AdmsMenu
{

    /** @var array $result Recebe os registros do banco de dados e retorna para a Contro ller */
    private array|null|bool $resultBd;

    public function itemMenu(): array|null|bool
    {
        $listMenu = new \App\adms\Models\helper\AdmsRead();
        $listMenu->fullRead("SELECT menu.id menu_id, menu.name menu_name, menu.icon icon_menu FROM adms_items_menus AS menu
                            ");

                            /* SELECT lev_pgs.id AS id_lev_pgs, lev_pgs.dropdown, lev_pgs.adms_page_id, lev_pgs.adms_items_menu_id,
                            pgs.id AS id_pgs, pgs.menu_controller, pgs.menu_metodo, pgs.name_page, pgs.icon,
                            menu.id AS id_menu, menu.name AS name_menu, menu.icon AS icon_menu
                            FROM adms_levels_pages AS lev_pgs
                            INNER JOIN adms_pages AS pgs ON pgs.id=lev_pgs.adms_page_id
                            INNER JOIN adms_items_menus as menu ON menu.id=lev_pgs.adms_items_menu_id
                            WHERE ((lev_pgs.adms_access_level_id =:adms_access_level_id) 
                            AND (lev_pgs.permission = 1))
                            AND print_menu = 1
                            ORDER BY menu.order_item_menu, lev_pgs.order_level_page ASC
                            ",
                            "adms_access_level_id=" . $_SESSION['adms_access_level_id'] */
        $this->resultBd = $listMenu->getResult();


        if($this->resultBd){
            return $this->resultBd;

        }else{
            return false;

        }

    }
    public function itemDropdown(): array|null|bool
    {

        $listDropDown = new \App\adms\Models\helper\AdmsRead();
        $listDropDown->fullRead("SELECT pgs.id id_pgs, pgs.menu_controller, pgs.menu_metodo, pgs.name_page, pgs.icon, lev_pgs.print_menu, lev_pgs.dropdown, lev_pgs.adms_items_menu_id, lev_pgs.adms_access_level_id
                                FROM adms_pages AS pgs
                                INNER JOIN adms_levels_pages AS lev_pgs ON lev_pgs.adms_page_id=pgs.id
                                INNER JOIN adms_items_menus AS menu ON menu.order_item_menu=lev_pgs.adms_items_menu_id
                                WHERE print_menu = 1 
                                AND permission = 1 
                                AND pgs.adms_groups_pgs_id = 1
                                OR pgs.adms_groups_pgs_id = 8
                                OR pgs.adms_groups_pgs_id = 7
                                AND lev_pgs.adms_access_level_id =:adms_access_level_id
                                ORDER BY lev_pgs.adms_items_menu_id ASC",
                                "adms_access_level_id=" . $_SESSION['adms_access_level_id']
                                );
        $this->resultBd = $listDropDown->getResult();
        
        if($this->resultBd){
            return $this->resultBd;

        }else{
            return false;

        }
    }

}
