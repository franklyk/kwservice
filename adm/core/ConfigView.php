<?php 

    namespace Core;

    /**
     * Carregar as páginas da View
     * 
     * @author Franklin (" klyk ") <frsbatist@gmail.com>
     */
    class ConfigView
    {

        /**
         * Recebe o endereço da VIEW e os dados
         *
         * @param string $nameView Endereço da VIEW que deve ser carregada 
         * @param array|string|null $data Dados que a VIEW deve receber 
         */
        public function __construct(private string $nameView, private array|string|null $data)
        {
        }


        /**
         * Carregar a VIEW
         * Verificar se o arquivo existe, e carregar caso exista, não existindo apresenta a mensagem de erro
         *
         * @return void
         */
        public function loadView():void
        {
            if(file_exists('app/' .$this->nameView . '.php')){
                include 'app/adms/Views/include/head.php';
                include 'app/' .$this->nameView . '.php';
                include 'app/adms/Views/include/footer.php';
            }else {
                die("Erro: 002 - Por Favor tente novamente! Se o problema persistir, entre em contato com o administrador em " . EMAILADM);
            }
        }
    }


?>