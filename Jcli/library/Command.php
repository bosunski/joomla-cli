<?php

    /**
     * Extended Command Class
     */
    class Command extends JApplicationCli
    {
        public $input;

        public function __construct()
        {
            $_SERVER['HTTP_HOST'] = 'localhost';
            $this->app = JFactory::getApplication('site');
            $this->input = new JCliInput;
        }

        //public function get() {}

        protected function getOption()
        {
            $this->input->get('sitename');
        }
    }
