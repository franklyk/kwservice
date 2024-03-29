<?php

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    
?>

<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Listar Situação</span>
            <div class="top-list-right">
                <?php
                if($this->data['button']['add_sits_users']){
                    echo "<a href='" . URLADM . "add-sits-users/index' class='btn-success'>".ICON_ADD." Cadastrar</a>";
                }
                ?>
            </div>
        </div>
        <div class="content-adm-alert">
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
        </div>
        <table class="table-list">
            <thead class="list-head">
                <tr>
                    <th class="list-head-content">ID</th>
                    <th class="list-head-content">Nome</th>
                    <th class="list-head-content"><?php echo ICON_SETTINGS ?> Ações</th>
                </tr>
            </thead>
            <tbody class="list-body">
                <?php
                foreach ($this->data['listSitsUsers'] as $sitUser) {
                    extract($sitUser);
                ?>
                    <tr>
                        <td class="list-body-content"><?php echo $id; ?></td>
                        <td class="list-body-content">
                            <?php echo "<span style='color: $color'>$name</span>"; ?>
                        </td>
                        <td class="list-body-content">
                            <div class="dropdown-action">
                                <button onclick="actionDropdown(<?php echo $id; ?>)" class="dropdown-btn-action"><?php echo ICON_SETTINGS ?> Ações</button>
                                <div id="actionDropdown<?php echo $id; ?>" class="dropdown-action-item">
                                    <?php
                                    if($this->data['button']){
                                        echo "<a href='" . URLADM . "view-sits-users/index/$id'>".ICON_VIEW." Visualizar</a>";
                                    }
                                    if($this->data['button']){
                                        echo "<a href='" . URLADM . "edit-sits-users/index/$id'>".ICON_EDIT." Editar</a>";
                                    }
                                    if($this->data['button']){
                                        echo "<a href='" . URLADM . "delete-sits-users/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir este registro?\")'>".ICON_DELETE." Apagar</a>";
                                    }
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

        <?php echo $this->data['pagination']; ?>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->
