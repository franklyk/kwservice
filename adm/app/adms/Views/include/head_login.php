<?php 


if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title><?php echo ADM ?></title>
        <link rel="shortcut icon" href="<?php echo URLADM; ?>app/adms/assets/image/icon/favicon.ico">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">                        
        <link rel="stylesheet" href="<?php echo URLADM; ?>app/adms/assets/css/custom_login.css">
    </head>
    <body class="d-flex">