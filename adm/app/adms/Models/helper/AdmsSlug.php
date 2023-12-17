<?php 

    namespace App\adms\Models\helper;

    /**
     * Classe genérica para converter o SLUG
     * 
     * @author Franklin <frsbatist@gmail.com>
     */
    class AdmsSlug
    {
        /** @var string $text Recebe o texto que deve ser convertido para o SLUG*/
        private string $text;

        /** @var array $format Recebe o array de caracteres especias que deve ser subistitudo */
        private array $format;

        
        public function slug(string $text): string|null
        {
            $this->text = $text;


            //Substitui Caracteres especiais
            $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:,\\\'<>°ºª';
            $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-----------------------------------------------------------------------------------------------';

            $this->text = strtr(utf8_decode($this->text), utf8_decode($this->format['a']), $this->format['b']);
            $this->text = str_replace(" ", "_", $this->text);
            $this->text = str_replace(array('_____', '____','___', '__'), '_', $this->text);
            $this->text = strtolower($this->text);


            return $this->text;
        }
    }

?>