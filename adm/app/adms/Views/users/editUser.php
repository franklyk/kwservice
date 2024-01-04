<?php 

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    if(isset($this->data['form'])){
        $valorForm = $this->data['form'];
    }
    if(isset($this->data['form'][0])){
        $valorForm = $this->data['form'][0];
    }
?>
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Editar Usuario</span>
            <div class="top-list-right">
                <?php 
                echo "<a href='" . URLADM . "list-users/index' class='btn-info'>Listar</a>";
                if(isset($valorForm['id'])){
                    echo "<a href='" . URLADM ."view-users/index/" . $valorForm['id'] . "' class='btn-primary'>Visualizar</a><br><br>";
                }
                ?>

            </div>
        </div>
        <div class="msg-alert">
            <?php 
            if(isset($_SESSION['msg'])){
                echo  "<span id='msg'>" . $_SESSION['msg'] ."</span> " ;
                unset($_SESSION['msg']);
            } else{
                echo "<span id='msg'></span>";
            }
            ?>
            
        </div>
        <div class="content-adm">
            <form method="POST" action="" class="form-adm" id="form-edit-user">
                <?php 
                    $id = "";
                    if(isset($valorForm['id'])){
                        $id = $valorForm['id'];
                    }
                ?>
                <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                <div class="row-input">
                    <div class="column">
                        <?php
                        $name = '';
                        if(isset($valorForm['name'])){
                            $name = $valorForm['name'];
                        }
                        ?>
                        <label for="name" class="title-input">Nome:<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="input-adm" id="name" placeholder="Digite o nome completo"
                            value="<?php echo $name ?>" required>
                    </div>
                    <div class="column">
                        <?php
                        $nickname = '';
                        if(isset($valorForm['nickname'])){
                            $nickname = $valorForm['nickname'];
                        }
                        ?>
                        <label for="nickname" class="title-input">Apelido:<span class="text-danger">*</span></label>
                        <input type="text" name="nickname" class="input-adm" id="nickname"
                            placeholder="Digite o apelido" value="<?php echo $name ?>" required>
                    </div>

                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $email = '';
                        if(isset($valorForm['email'])){
                            $email = $valorForm['email'];
                        }
                        ?>
                        <label for="email" class="title-input">E-mail:<span class="text-danger">*</span></label>
                        <input type="email" name="email" class="input-adm" id="email"
                            placeholder="Digite o seu melhor e-mail" value="<?php echo $email ?>" required>
                    </div>
                    <div class="">
                        <?php
                        $user = '';
                        if(isset($valorForm['user'])){
                            $user = $valorForm['user'];
                        }
                        ?>
                        <label for="user" class="title-input">Usuário:<span class="text-danger">*</span></label>
                        <input type="text" name="user" class="input-adm" id="user" placeholder="Digite o usuario"
                            value="<?php echo $user ?>" required>

                    </div>
                </div>
                <div class="row-input">

                    <div class="column">
                        <label class="title-input">Nivel de Acesso:<span class="text-danger">*</span></label>
                        <select name="adms_access_levels" id="adms_access_levels" class="input-adm" required>
                            <option value="">Selecione</option>
                            <?php 
                            foreach ($this->data['select']['acl'] as $acl){
                                extract($acl);
                                if((isset($valorForm['adms_level_id'])) and ($valorForm['adms_level_id'] == $id_level)){
                                    echo "<option value='$id_level' selected>$name_level</option>";
                                }else{
                                    echo "<option value='$id_level'>$name_level</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="column">
                        <label class="title-input">Situação:<span class="text-danger">*</span></label>
                        <select name="adms_sits_user_id" id="adms_sits_user_id" class="input-adm" required>
                            <option value="">Selecione</option>
                            <?php
                                foreach ($this->data['select']['sit'] as $sit){
                                    extract($sit);
                                    if((isset($valorForm['adms_sits_user_id'])) and ($valorForm['adms_sits_user_id'] == $id_sit)){
                                        echo "<option value='$id_sit' selected>$name_sit</option>";
                                    }else{
                                        echo "<option value='$id_sit'>$name_sit</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>

                <div class="column btn-complete">
                    <button type="submit" name="SendEditUser" class="btn btn-warning " value="Salvar">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>