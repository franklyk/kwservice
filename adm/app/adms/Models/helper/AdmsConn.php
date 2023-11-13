<?php 

    namespace App\adms\Models\helper;

    use PDO;
    use PDOException;

    /**
     * Cria a connexão com a base de dados
     * 
     * @author Franklin (" KLYK ") <frsbatist@gmail.com>
     */
    abstract class AdmsConn
    {
        /** @var string $host Recebe o host da constante HOST*/
        private string $host = HOST;
        /** @var string $user Recebe o usuario da constante USER*/
        private string $user = USER;
        /** @var string $pass Recebe a senha da constante PASS*/
        private string $pass = PASS;
        /** @var string $dbname Recebe o nome da base de dados da constante DBNAME*/
        private string $dbname = DBNAME;
        /** @var string $port Recebe a porta da constante PORT*/
        private int|string $port = PORT;
        /** @var object $connect Recebe a conexão com a bese de dados*/
        private object $connect;

        /**
         * Realiza a conexão com o banco de dados, não encontrando, para a execução e mostra uma mensagem de erro
         *  
         *
         * @return object Retorna a conexão com o banco de dados
         */
        protected function connectDB(): object
        {
            try{

                //Conexão com a porta (Testes revelaram que a conexão com a porta foi recusada no WAMP-SERVER, ainda não há respostas sobre conexões em hospedagens e não foi testado no XAMPP)

                // $this->connect = new PDO("mysql:host={$this->host};port{$this->port};dbname=". $this->dbname,  $this->user, $this->pass);


                //Conexão sem a porta
                $this->connect = new PDO("mysql:host={$this->host};dbname=". $this->dbname,  $this->user, $this->pass);
                
                return $this->connect;
            }
            catch(PDOException $err){
                //Encerra o precesso e emite a mensagem de erro
                die("Por Favor tente novamente! Se o problema persistir, entre em contato com o administrador em " . EMAILADM);
            }
        }

    }


?>