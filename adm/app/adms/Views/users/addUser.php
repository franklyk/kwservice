<?php 

    if(!defined('KLKSK8')){
        $urlRedirect = "http://localhost/kwservice/adm/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada!<br>");
    }
    //Verifica se existe dados no formulário, se houver mantém os dados no INPUT
    if(isset($this->data['form'])){
        $valorForm = $this->data['form'];
        // var_dump($this->data['form']);
    }
?>
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Cadastrar Usuario</span>
            <div class="top-list-right">
                <?php 
                echo "<a href='" . URLADM . "list-users/index' class='btn-info'>Listar</a>";
                ?>
            </div>
        </div>
        <div class="content-adm-alert">
            <?php 
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            } 
            ?>
            <span id="msg"></span>
        </div>
        <div class="content-adm">
            <form method="POST" action="" class="form-adm" id="form-add-user">
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
                        $email = '';
                        if(isset($valorForm['email'])){
                            $email = $valorForm['email'];
                        }
                        ?>
                        <label for="email" class="title-input">E-mail:<span class="text-danger">*</span></label>
                        <input type="email" name="email" class="input-adm" id="email"
                            placeholder="Digite o seu melhor e-mail" value="<?php echo $email ?>" required>
                    </div>

                </div>
                <div class="row-input">
                    <div class="column">
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
                    <div class="column">
                        <?php
                        $password = '';
                        if(isset($valorForm['password'])){
                            $password = $valorForm['password'];
                        }
                        ?>
                        <label for="password" class="title-input">Senha:<span class="text-danger">*</span></label>
                        <input type="password" name="password" class="input-adm" id="password"
                            placeholder="Digite sua senha" value="<?php echo $password ?>" required>
                    </div>

                </div>
                <div class="row-input">
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
                    <div class="column btn-complete">
                        <button type="submit" name="SendAddUser" class="btn-success "
                            value="Cadastrar">Cadastrar</button>
                    </div>
                </div>
                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>
            </form>
        </div>
    </div>
</div>