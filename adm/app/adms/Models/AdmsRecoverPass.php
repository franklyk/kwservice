<?php

namespace App\adms\Models;


/**
 * Solicitar novo link para cadastrar nova senha
 *
 * @author Franklin 
 */
class AdmsRecoverPass
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
    public function recoverPassword(array $data = null): void
    {
        $this->data = $data;
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {
            $this->valUser();
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }

    private function valUser(): void
    {
        $newConfEmail = new \App\adms\Models\helper\AdmsRead();
        $newConfEmail->fullRead(
            "SELECT id, name, email FROM adms_users
                                WHERE email=:email
                                LIMIT :limit",
            "email={$this->data['email']}&limit=1"
        );
        $this->resultBd = $newConfEmail->getResult();
        if ($this->resultBd) {
            $this->valConfEmail();
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: E-mail não cadastrado!</p>";
            $this->result = false;
        }
    }

    private function valConfEmail(): void
    {
        $this->dataSave['recover_password'] = password_hash(date("Y-m-d H:i:s") . $this->resultBd[0]['id'], PASSWORD_DEFAULT);

        $upNewConfEmail = new \App\adms\Models\helper\AdmsUpdate();
        $upNewConfEmail->exeUpdate("adms_users", $this->dataSave, "WHERE id=:id", "id={$this->resultBd[0]['id']}");

        if ($upNewConfEmail->getResult()) {
            $this->resultBd[0]['recover_password'] = $this->dataSave['recover_password'];
            $this->sendEmail();
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Link não enviado, tente novamente!</p>";
            $this->result = false;
        }
    }

    private function sendEmail(): void
    {
        $sendEmail = new \App\adms\Models\helper\AdmsSendEmail();
        $this->emailHTML();
        $this->emailText();
        $sendEmail->sendEmail($this->emailData, 2);
        if ($sendEmail->getResult()) {
            $_SESSION['msg'] = "<p style='color: green;'>Novo link enviado com sucesso. Acesse a sua caixa de e-mail para confimar o e-mail!</p>";
            $this->result = true;
        } else {
            $this->fromEmail = $sendEmail->getFromEmail();
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Link não enviado, tente novamente ou entre em contato com o e-mail {$this->fromEmail}!</p>";
            $this->result = false;
        }
    }

    private function emailHTML(): void
    {
        $name = explode(" ", $this->resultBd[0]['name']);
        $this->firstName = $name[0];

        $this->emailData['toEmail'] = $this->data['email'];
        $this->emailData['toName'] = $this->resultBd[0]['name'];
<<<<<<< HEAD
        $this->emailData['subject'] = "Recuparar a senha! ";
        $this->url = URLADM . "update-password/index?key=" . $this->resultBd[0]['recover_password'];

        $this->emailData['contentHtml'] = "<h1 style='color:tomato;'>KWService.com</h1><br><br>";
        $this->emailData['contentHtml'] = "Prezado(a) {$this->firstName}<br><br>";
        $this->emailData['contentHtml'] .= "Você solicitou a alteração de sua senha!<br><br>";
        $this->emailData['contentHtml'] .= "Para confirmar clique no link abaixo: <br><br>";
        $this->emailData['contentHtml'] .= "<a href='{$this->url}'>{$this->url}</a> <br>";
        $this->emailData['contentHtml'] .= "Você será redirecionado para a página de alteração de senha no nosso site.
        <br> 
        Lembre-se: você não deve compartilhar os dados cadastrais.
        <br>
        Atenciosamente  suporte@kwservice.com
        <br>
        "
        ;
=======
        $this->emailData['subject'] = "Recupara senha! ";
        $this->url = URLADM . "update_password/index?key=" . $this->resultBd[0]['recover_password'];

        $this->emailData['contentHtml'] = "Prezado(a) {$this->firstName}<br><br>";
        $this->emailData['contentHtml'] .= "Agradecemos a sua solicitação de cadastro em nosso site!<br><br>";
        $this->emailData['contentHtml'] .= "Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: <br><br>";
        $this->emailData['contentHtml'] .= "<a href='{$this->url}'>{$this->url}</a><br><br>";
        $this->emailData['contentHtml'] .= "Esta mensagem foi enviada a você pela empresa XXX.<br>Você está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.<br><br>";
>>>>>>> 1ebb21a97e10742749e7950cb5ef40e259103698
    }

    private function emailText(): void
    {
<<<<<<< HEAD
        $this->emailData['contentText'] = "KWService.com\n\n";
        $this->emailData['contentText'] = "Prezado(a) {$this->firstName}\n\n";
        $this->emailData['contentText'] .= "Você solicitou a alteração de sua senha!\n\n";
        $this->emailData['contentText'] .= "Para confirmar copie o link abaixo e cole no navegador:  \n\n";
        $this->emailData['contentText'] .=  $this->url . "\n\n";
        $this->emailData['contentText'] .= "Você será redirecionado para a página de alteração de senha no nosso site.
        \n\n
        Lembre-se: você não deve compartilhar os dados cadastrais.
        \n\n
        Atenciosamente  suporte@kwservice.com
        \n\n";
=======
        $this->emailData['contentText'] = "Prezado(a) {$this->firstName}\n\n";
        $this->emailData['contentText'] .= "Agradecemos a sua solicitação de cadastro em nosso site!\n\n";
        $this->emailData['contentText'] .= "Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: \n\n";
        $this->emailData['contentText'] .=  $this->url . "\n\n";
        $this->emailData['contentText'] .= "Esta mensagem foi enviada a você pela empresa XXX.\nVocê está recebendo porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.\n\n";
>>>>>>> 1ebb21a97e10742749e7950cb5ef40e259103698
    }
}
