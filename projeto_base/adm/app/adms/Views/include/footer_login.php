<?php 


if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}

?>

<script src="<?php echo URLADM; ?>app/adms/assets/Js/custom_login.js"></script>
</body>

</html>