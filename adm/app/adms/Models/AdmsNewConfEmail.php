<?php

namespace App\adms\Models;

use \App\adms\Models\helper\AdmsConn;
use PDO;

/**
 * Solicitar novo link para confirmar o email
 *
 * @author Franklin (" KLYK ") <frsbatist@gmail.com>
 */
class AdmsNewConfEmail extends helper\AdmsConn
{
    /** @var array|null $data Recebe as informações do formulário */
    private array|null $data;


    private string $url;


    /** @var string Recebe o primeiro nome do usuario */
    private string $firstname;

    /** @var array Recebe os dados do conteúdo do e-mail */
    private array $emailData;

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /** @var string $fromEmail Recebe o e-mail do remetente */
    private string $fromEmail;

    /** @var $resultBD Recebe o valor retornado do banco de dados*/
    private array|null $resultBd;


    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /** 
     * Recebe os valores do formulário.
     * Instancia o helper "AdmsValEmptyField" para verificar se todos os campos estão preenchidos 
     * Verifica se todos os campos estão preenchidos e instancia o método "valInput" para validar os dados dos campos
     * Retorna FALSE quando algum campo está vazio
     * 
     * @param array $data Recebe as informações do formulário
     * 
     * @return void
     */
    public function newConfEmail(array $data = null): void
    {
        $this->data = $data;

        $newConfEmail = new \App\adms\Models\helper\AdmsRead();
        $newConfEmail->fullRead("SELECT id, name, email, conf_email FROM adms_users WHERE email =:email LIMIT :limit", "email={$this->data['email']}&limit=1");

        $this->resultBd = $newConfEmail->getResult();
        if ($this->resultBd) {
            $this->valConfEmail();
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: O E-mail informado não está cadastrado!</p>";
            $this->result = false;
        }
    }
    private function valConfEmail(): void
    {
        if ((empty($this->resultBd[0]['conf_email'])) or ($this->resultBd[0]['conf_email'] == null)) {
            $conf_email = password_hash(date("Y-m-d H-i-s") . $this->resultBd[0]['id'], PASSWORD_DEFAULT);

            $query_activate_user = "UPDATE adms_users SET conf_email=:conf_email, modified = NOW() WHERE id=:id LIMIT :limit";

            $activate_user = $this->connectDB()->prepare($query_activate_user);
            $activate_user->bindparam(':conf_email', $conf_email);
            $activate_user->bindparam(':id', $this->resultBd[0]['id']);
            $activate_user->bindvalue(':limit', 1, PDO::PARAM_INT);
            $activate_user->execute();

            if ($activate_user->rowCount()) {
                $this->resultBd[0]['conf_email'] = $conf_email;
                $this->sendEmail();
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Link não enviado. Tente novamente!</p>";
                $this->result = false;
            }
            // $this->result = false;
        } else {
            $this->sendEmail();
        }
    }
    private function sendEmail(): void
    {
        $sendEmail = new \App\adms\Models\helper\AdmsSendEmail();
        $this->emailHtml();
        $this->emailText();
        $sendEmail->sendEmail($this->emailData, 2);
        if ($sendEmail->getResult()) {
            $_SESSION['msg'] = "<p style='color: #0f0;'>Erro: Novo link enviado com sucesso, acesse sua caixa de entrada para confirmar o email!</p>";
            $this->result = true;

        } else {
            $this->fromEmail = $sendEmail->getFromEmail();
            $_SESSION['msg'] = "<p style='color: #f00;'>Usuário cadastrado com sucesso. Houve erro ao enviar o e-mail de confirmação, entre em contado com {$this->fromEmail} para mais informações!</p>";
            $this->result = false;
        }
    }
    private function emailHtml(): void
    {
        $name = explode(" ", $this->resultBd[0]['name']);
        $this->firstname = $name[0];

        $this->emailData['toEmail'] = $this->data['email'];
        $this->emailData['toName'] = $this->data['name'];
        $this->emailData['subject'] = "Confirmar sua conta ";
        $this->url = URLADM . "conf-email/index?key=" . $this->resultBd[0]['conf_email'];

        $this->emailData['contentHtml'] = "Prezado(a) {$this->firstname} <br><br>";
        $this->emailData['contentHtml'] .= "Agradecemos a sua solicitação de cadastro em nosso site! <br><br>";
        $this->emailData['contentHtml'] .= "Para que possamos liberar seu cadastro em nosso sistema, solicitamos a confirmação de e-mail clicando no link abaixo: <br> <br> ";
        $this->emailData['contentHtml'] .= "<a href='$this->url'> $this->url </a> <br> <br>";
        $this->emailData['contentHtml'] .= "Esta mensagem foi enviada a você pela empresa KWService. <br> Você está cadastrado na nossa base de dados. <br> Nenhum e-mail enviado por nós tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.<br> <br> ";
    }
    private function emailText(): void
    {
        $this->url = URLADM . "conf-email/index?key=" . $this->data['conf_email'];

        $this->emailData['contentText'] = "Prezado(a) {$this->firstname} \n\n";
        $this->emailData['contentText'] .= "Agradecemos a sua solicitação de cadastro em nosso site!";
        $this->emailData['contentText'] .= "Para que possamos liberar seu cadastro em nosso sistema, solicitamos a confirmação de e-mail clicando no link abaixo: \n\n";
        $this->emailData['contentText'] .= $this->url    . "\n\n";
        $this->emailData['contentText'] .= "Esta mensagem foi enviada a você pela empresa KWService. <br> Você está cadastrado na nossa base de dados. \n Nenhum e-mail enviado por nós tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais. \n\n";
    }
}
