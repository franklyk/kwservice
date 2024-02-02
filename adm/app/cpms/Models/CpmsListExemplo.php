<?php

namespace App\cpms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}
/**
 * Página exemplo pacote complementar
 *
 * @author Franklin
 */
class CpmsListExemplo
{

    public function listExemplo(): void
    {
    }
}