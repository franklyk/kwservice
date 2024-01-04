<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


use App\adms\Models\helper\AdmsConn;
use PDO;

/**
 * Solicitar novo link para confirmar o e-mail
 *
 * @author Franklin 
 */
class AdmsNewConfEmail extends AdmsConn
{

    /** @var array|null $data Recebe as informações do formulário */
    private array|null $data;

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private string|null|bool $result;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var string $firstName Recebe o primeiro nome do usuário */
    private string $firstName;

    /** @var string $fromEmail Recebe o e-mail do remetente */
    private string $fromEmail = EMAILADM;

    private string $url;

    /** @var array $emailData Recebe dados do conteúdo do e-mail */
    private array $emailData;

    private array $dataSave;


    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /** 
     * 
     * @return void
     */
    public function newConfEmail(array $data = null): void
    {
        $this->data = $data;
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {
            $this->valUser();
        } else {
            $this->result = false;
        }
    }

    private function valUser(): void
    {
        $newConfEmail = new \App\adms\Models\helper\AdmsRead();
        $newConfEmail->fullRead(
            "SELECT id, name, email, conf_email 
                                FROM adms_users
                                WHERE email=:email
                                LIMIT :limit",
            "email={$this->data['email']}&limit=1"
        );
        $this->resultBd = $newConfEmail->getResult();
        if ($this->resultBd) {
            $this->valConfEmail();
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: E-mail não cadastrado!</p>";
            $this->result = false;
        }
    }

    private function valConfEmail(): void
    {
        if ((empty($this->resultBd[0]['conf_email'])) or ($this->resultBd[0]['conf_email'] == NULL)) {
            $this->dataSave['conf_email'] = password_hash(date("Y-m-d H:i:s") . $this->resultBd[0]['id'], PASSWORD_DEFAULT);
            $this->dataSave['modified'] = date("Y-m-d H:i:s");


            $upNewConfEmail = new \App\adms\Models\helper\AdmsUpdate();
            $upNewConfEmail->exeUpdate("adms_users", $this->dataSave, "WHERE id=:id", "id={$this->resultBd[0]['id']}");

            if ($upNewConfEmail->getResult()) {
                $this->resultBd[0]['conf_email'] = $this->dataSave['conf_email'];
                $this->sendEmail();
            } else {
                $_SESSION['msg'] = "<p class='alert-danger'>Erro: Link não enviado, tente novamente!</p>";
                $this->result = false;
            }
        } else {
            $this->sendEmail();
        }
    }

    private function sendEmail(): void
    {
        $sendEmail = new \App\adms\Models\helper\AdmsSendEmail();
        $this->emailHTML();
        $this->emailText();
        $sendEmail->sendEmail($this->emailData, 2);
        if ($sendEmail->getResult()) {
            $_SESSION['msg'] = "<p class='alert-success'>Novo link enviado com sucesso. Acesse a sua caixa de e-mail para confimar o e-mail!</p>";
            $this->result = true;
        } else {
            $this->fromEmail = $sendEmail->getFromEmail();
            $_SESSION['msg'] = "<p class='alert-success'>Erro: Link não enviado, tente novamente ou entre em contato com o e-mail {$this->fromEmail}!</p>";
            $this->result = false;
        }
    }

    private function emailHTML(): void
    {
        $name = explode(" ", $this->resultBd[0]['name']);
        $this->firstName = $name[0];

        $this->emailData['toEmail'] = $this->data['email'];
        $this->emailData['toName'] = $this->resultBd[0]['name'];
        $this->emailData['subject'] = "Confirma sua conta";
        $this->url = URLADM . "conf-email/index?key=" . $this->resultBd[0]['conf_email'];

        $this->emailData['contentHtml'] = "<h1 style='color:tomato;'>KWService</h1> <br><br>";
        $this->emailData['contentHtml'] = "Olá {$this->firstName}! <br><br>";
        $this->emailData['contentHtml'] = "Bem Vindo à KWService.com <br><br>";
        $this->emailData['contentHtml'] .= "É um prazer ter você conosco!<br><br>";
        $this->emailData['contentHtml'] .= "Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail. clique no link abaixo: <br><br>";
        $this->emailData['contentHtml'] .= "<a href='{$this->url}'>Acessar</a> <br><br>";
        $this->emailData['contentHtml'] .= "Lembre-se de não compartilhar os seus dados.
        <br>
        Informamos que não enviamos mensagens pedindo que informe suas credenciais ou que faça qualquer confirmação de senha.
        <br>
        Em caso de dúvida entre em contatos conosco.
        <br>
        Atenciosamente suporte@kwservice.com
        <br><br>
        
        ";
    }

    private function emailText(): void
    {

        $this->emailData['contentText'] = "Olá {$this->firstName}\n\n";
        $this->emailData['contentText'] = "Bem Vindo à KWService.com \n\n";
        $this->emailData['contentText'] .= "É um prazer ter você conosco!\n\n";
        $this->emailData['contentText'] .= "Para que possamos liberar o seu cadastro em nosso sistema, copie o link abaixo e cole no navegador para acessar: \n\n";
        $this->emailData['contentText'] .=  $this->url . "\n\n";
        $this->emailData['contentText'] .= "Lembre-se de não compartilhar os seus dados.\n
        Informamos que não enviamos mensagens pedindo que informe suas credenciais ou que faça qualquer confirmação de senha.
        \n\n
        Em caso de dúvida entre em contatos conosco.
        \n\n
        Atenciosamente suporte@kwservice.com
        \n\n

        ";
    }
}
