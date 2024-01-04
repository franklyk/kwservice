<?php

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");

}

if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}
?>
<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Cadastrar Novo Nível</span>
            <div class="top-list-right">
                <?php
                echo "<a href='" . URLADM . "list-access-levels/index' class='btn-info'>Listar</a> ";
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
            <span id="msg"></span>
        </div>

        <div class="content-adm">
            <form method="POST" action="" id="form-access-levels" class="form-adm">
                <div class="row-input">
                    <div class="column">
                        <?php
                        $name = "";
                        if (isset($valorForm['name'])) {
                            $name = $valorForm['name'];
                        }
                        ?>
                        <label class="title-input">Nome:<span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="input-adm" placeholder="Digite o nome do nível" value="<?php echo $name; ?>" >
                    </div>
                </div>

                <!-- <div class="row-input">
                    <div class="column">
                        <?php
                        // $order_level = "";
                        // if (isset($valorForm['order_level'])) {
                        //     $order_level = $valorForm['order_level'];
                        // }
                        ?>
                        <label class="title-input">Nível:<span class="text-danger">*</span></label>
                        <input type="text" name="order_level" id="order_level" class="input-adm" placeholder="Digite o nível de acesso" value="<?php /*echo $order_level;*/ ?>" >

                    </div>
                </div> -->

                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>

                <button type="submit" name="SendAddAccessLevels"  class="btn btn-success" value="Cadastrar">Cadastrar</button>

            </form>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->