<?php

namespace App\adms\Models;

if(!defined('KLKSK8')){
    $urlRedirect = "http://localhost/kwservice/adm/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada!<br>");
}


/**
 * Cadastrar o usuário no banco de dados
 *
 * @author Franklin
 */
class AdmsNewUser
{
    /** @var array|null $data Recebe as informações do formulário */
    private array|null $data;

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /** @var string $fromEmail Recebe o e-mail do remetente */
    private string $fromEmail;

    /** @var string Recebe o primeiro nome do usuario */
    private string $firstName;

    private array $emailData;

    private string $url;

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
    public function create(array $data = null)
    {
        $this->data = $data;

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {
            $this->valInput();
        } else {
            $this->result = false;
        }
    }

    /** 
     * Instanciar o helper "AdmsValEmail" para verificar se o e-mail válido
     * Instanciar o helper "AdmsValEmailSingle" para verificar se o e-mail não está cadastrado no banco de dados, não permitido cadastro com e-mail duplicado
     * Instanciar o helper "validatePassword" para validar a senha
     * Instanciar o helper "validateUserSingleLogin" para verificar se o usuário não está cadastrado no banco de dados, não permitido cadastro com usuário duplicado
     * Instanciar o método "add" quando não houver nenhum erro de preenchimento 
     * Retorna FALSE quando houve algum erro
     * 
     * @return void
     */
    private function valInput(): void
    {
        $valEmail = new \App\adms\Models\helper\AdmsValEmail();
        $valEmail->validateEmail($this->data['email']);

        $valEmailSingle = new \App\adms\Models\helper\AdmsValEmailSingle();
        $valEmailSingle->validateEmailSingle($this->data['email']);

        $valPassword = new \App\adms\Models\helper\AdmsValPassword();
        $valPassword->validatePassword($this->data['password']);

        $valUserSingleLogin = new \App\adms\Models\helper\AdmsValUserSingleLogin();
        $valUserSingleLogin->validateUserSingleLogin($this->data['email']);

        if (($valEmail->getResult()) and ($valEmailSingle->getResult()) and ($valPassword->getResult()) and ($valUserSingleLogin->getResult())) {
            $this->add();
        } else {
            $this->result = false;
        }
    }

    /** 
     * Cadastrar usuário no banco de dados
     * Retorna TRUE quando cadastrar o usuário com sucesso
     * Retorna FALSE quando não cadastrar o usuário
     * 
     * @return void
     */
    private function add(): void
    {
        $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
        $this->data['user'] = $this->data['email'];
        $this->data['conf_email'] = password_hash($this->data['password']. date("Y-m-d H-i-s"), PASSWORD_DEFAULT);
        $this->data['created'] = date("Y-m-d H:i:s");

        $createUser = new \App\adms\Models\helper\AdmsCreate();
        $createUser->exeCreate("adms_users", $this->data);

        if ($createUser->getResult()) {
            $_SESSION['msg'] = "<p class='alert-success'>Usuário cadastrado com sucesso!</p>";
            $this->result = true;
            $this->sendEmail();
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário não cadastrado com sucesso!</p>";
            $this->result = false;
        }
    }

    private function sendEmail(): void
    {
        $this->contentEmailHtml();
        $this->contentEmailText();

        $sendEmail = new \App\adms\Models\helper\AdmsSendEmail();
        $sendEmail->sendEmail($this->emailData, 2);
        if ($sendEmail->getResult()) {
            $_SESSION['msg'] = "<p class='alert-success'>Usuário cadastrado com sucesso. Acesse a sua caixa de entrada para confimar o e-mail!</p>";
            $this->result = true;
        } else {
            $this->fromEmail = $sendEmail->getFromEmail();
            $_SESSION['msg'] = "<p class='alert-danger'>Usuário cadastrado com sucesso. Houve erro ao enviar o e-mail de confirmação, entre em contado com {$this->fromEmail} para mais informações!</p>";
            $this->result = true;
        }
    }

    private function contentEmailHtml(): void
    {
        $name = explode(" ", $this->data['name']);
        $this->firstName = $name[0];

        $this->emailData['toEmail'] = $this->data['email'];
        $this->emailData['toName'] = $this->data['name'];
        $this->emailData['subject'] = "Confirmar sua conta ";
        $this->url = URLADM . "conf-email/index?key=". $this->data['conf_email'];

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

    private function contentEmailText(): void
    {
        $this->url = URLADM . "conf-email/index?key=". $this->data['conf_email'];

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
