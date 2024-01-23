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
        $listMenu->fullRead("SELECT lev_pgs.id AS id_lev_pgs, lev_pgs.adms_page_id,
                            pgs.id AS id_pgs, pgs.menu_controller, pgs.menu_metodo, pgs.name_page, pgs.icon
                            FROM adms_levels_pages AS lev_pgs
                            INNER JOIN adms_pages AS pgs ON pgs.id=lev_pgs.adms_page_id
                            WHERE ((lev_pgs.adms_access_level_id =:adms_access_level_id) 
                            AND (lev_pgs.permission = 1))
                            AND print_menu = 1
                            ORDER BY lev_pgs.id ASC",
                            "adms_access_level_id=" . $_SESSION['adms_access_level_id']
                            );
        $this->resultBd = $listMenu->getResult();
        if($this->resultBd){
            return $this->resultBd;

        }else{
            return false;

        }

    }
    

}
