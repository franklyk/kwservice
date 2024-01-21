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
            <span class="title-content">Listar Usuários</span>
            <div class="top-list-right">
                <?php
                if($this->data['button']['add_users']){
                    echo "<a href='" .URLADM . "add-users/index' class='btn-success'>".ICON_ADD." Cadastrar</a>";
                }
                ?>
            </div>
        </div>
        <div class="top-list">
            <form method="post" action="">
                <div class="row-input-search">
                    <div class="column">
                        <label class="title-input-search">Nome: </label>
                        <input type="text" name="search_name" id="search_name" class="input-search"
                            placeholder="Pesquisar pelo nome...">
                    </div>

                    <div class="column">
                        <label class="title-input-search">E-mail: </label>
                        <input type="text" name="search_email" id="search_email" class="input-search"
                            placeholder="Pesquisar pelo e-mail...">
                    </div>

                    <div class="column margin-top-search">
                        <button type="submit" name="SendSearchUser" value="pesquisar"
                            class="btn-info"><?php echo ICON_SEARCH?> Pesquisar</button>
                    </div>
                </div>
            </form>
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
                    <th class="list-head-content">Nome</th>
                    <th class="list-head-content table-sm-none">E-mail</th>
                    <th class="list-head-content table-md-none">Situação</th>
                    <th class="list-head-content table-md-none">Nível de acesso</th>
                    <?php 
                        if($this->data['button']){
                            echo "<th class='list-head-content'>". ICON_SETTINGS ." Ações</th>";
                        }
                    ?>
                </tr>
            </thead>
            <tbody class="list-body">
                <?php
                foreach ($this->data['listUsers'] as $user) {
                    extract($user);
                ?>
                <tr>
                    <td class="list-body-content"><?php echo $id; ?></td>
                    <td class="list-body-content"><?php echo $name_usr; ?></td>
                    <td class="list-body-content table-sm-none"><?php echo $email; ?></td>
                    <td class="list-body-content table-md-none">
                        <?php echo "<span style='color: $color'>$name_sit</span>"; ?>
                    </td>
                    <td class="list-body-content table-sm-none"><?php echo $name_level; ?></td>
                    <td class="list-body-content">
                        <div class="dropdown-action">
                            <?php 
                                if($this->data['button']){
                                    echo "<button onclick='actionDropdown(". $id .")' class='dropdown-btn-action'>".ICON_SETTINGS. "Ações</button>";
                                }
                                 echo "<div id='actionDropdown$id' class='dropdown-action-item'>";
                                if($this->data['button']['view_users']){
                                    echo "<a href='" . URLADM . "view-users/index/$id'>".ICON_VIEW." Visualizar</a>";
                                }
                                if($this->data['button']['edit_users']){
                                    echo "<a href='" . URLADM . "edit-users/index/$id'>".ICON_EDIT." Editar</a>";
                                }
                                if($this->data['button']['delete_users']){
                                    echo "<a href='" . URLADM . "delete-users/index/$id' onclick='return confirm(\"Tem certeza que deseja excuir este Registro?\")'>".ICON_DELETE." Apagar</a>";
                                }
                                echo "</div>";
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