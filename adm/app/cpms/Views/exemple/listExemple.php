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
            <span class="title-content">Exemplo</span>
            <div class="top-list-right">
                <?php
                /*if($this->data['button']['add_users']){
                    echo "<a href='" .URLADM . "add-users/index' class='btn-success'>".ICON_ADD." Cadastrar</a>";
                }*/
                ?>
            </div>
        </div>
    </div>
</div>