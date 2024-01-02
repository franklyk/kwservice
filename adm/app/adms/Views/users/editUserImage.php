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
            <span class="title-content">Editar Imagem</span>
            <div class="top-list-right">
                <?php 
                echo "<a href='" . URLADM . "list-users/index' class='btn-info'>Listar</a>";
                if(isset($valorForm['id'])){
                    echo "<a href='" . URLADM ."view-users/index/" . $valorForm['id'] . "' class='btn-primary'>Visualizar</a><br><br>";
                }
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
            <form method="POST" action="" class="form-adm" id="form-edit-user-img" enctype="multipart/form-data">
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
                        <label for="name" class="title-input">Imagem:<span class="text-danger">*</span>300x300</label>
                        <input type="file" name="new_image" id="new_image" class="input-adm"
                            onchange="inputFileValImg()">
                    </div>
                    <div class="column">
                        <?php
                        $nickname = '';
                        if((!empty($valorForm['image'])) and (file_exists("app/adms/assets/images/users/" . $valorForm['id'] . "/" . $valorForm['image']))){
                            $old_image = URLADM . "app/adms/assets/images/users/" . $valorForm['id'] . "/" . $valorForm['image'];
                        }else{
                            $old_image = URLADM . "app/adms/assets/images/users/usuario.png";
                        }
                        ?>
                        <span id="preview-img">
                            <img src="<?php echo $old_image; ?>" alt="Imagem" style="width:200px;">
                        </span>
                    </div>
                </div>

                <div class="row-input" style="height: auto;">
                    <div class="column btn-complete">
                        <button type="submit" name="SendEditUserImage" class="btn-warning " value="Salvar">Salvar</button>
                    </div>

                </div>
                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>
            </form>
        </div>
    </div>
</div>