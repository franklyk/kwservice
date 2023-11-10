<?php 

    namespace Core;

    /**
     * Crregar as páginas da View
     * 
     * @author Franklin (" klyk ") <frsbatist@gmail.com>
     */
    class ConfigView
    {
        public function __construct(private string $nameView)
        {
        }
        public function loadView(): void
        {
            var_dump($this->nameView);
        }
    }


?>