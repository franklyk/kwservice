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
                echo "<a href='" .URLADM . "add-users/index' class='btn-success'>Cadastrar</a>";
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
                                <button type="submit" name="SendSearchUser" value="pesquisar" class="btn-info">Pesquisar</button>
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
                    <th class="list-head-content">Ações</th>
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
                            <button onclick="actionDropdown(<?php echo $id; ?>)"
                                class="dropdown-btn-action">Ações</button>
                            <div id="actionDropdown<?php echo $id; ?>" class="dropdown-action-item">
                                <?php
                                    echo "<a href='" . URLADM . "view-users/index/$id'>Visualizar</a>";
                                    echo "<a href='" . URLADM . "edit-users/index/$id'>Editar</a>";
                                    echo "<a href='" . URLADM . "delete-users/index/$id' onclick='return confirm(\"Tem certeza que deseja excuir este Registro?\")'>Apagar</a>";
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
        <div class="content-pagination">
            <div class="pagination">
                <?php 
                echo $this->data['pagination']; 
                ?>
            </div>
        </div>
    </div>
</div>