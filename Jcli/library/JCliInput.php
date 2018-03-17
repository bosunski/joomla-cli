<?php
    /**
     *    Handles All Input Resolution
     */
    class JCliInput
    {

        public function __construct()
        {
            $this->configure();
        }

        // Gets the direct name of command
        public function getname()
        {

        }

        private function configure()
        {
            global $argc;
            global $argv;
            $this->argc = $argc;
            $this->argv = $argv;
            unset($this->argv[0]);
            $this->args = array_values($this->argv);

            $this->getOptionsAndValues();
        }


        public function getCommand($command)
        {
            return $command == $this->getBaseCommand();
        }

        private function getBaseCommand()
        {
            return $this->args[0];
        }

        public function getOptions()
        {
            return $this->args[1];
        }

        public function getOptionValue($option)
        {
            if(!isset($this->args[1])) { return ''; };
            $option = '--' . $option . '=';
            $arr = explode($option, $this->args[1]);
            $option = $arr[0] ?? '';
            $value = $arr[1] ?? '';
            return isset($value) ? $value : '';
        }

        public function getOptionName()
        {
            if(!isset($this->args[1])) { return ''; };
            $arr = explode('--', $this->args[1]);
            $option = $arr[0] ?? '';
            $value = $arr[1] ?? '';
            return isset($value) ? $value : '';
        }

        public function getOptionsAndValues()
        {
            if(!isset($this->args[1])) { return ''; };

            if(strpos($this->args[1], '--') === false) {
                $this->optionValue = $this->args[1];
                return ;
            } else {
                //exit($this->args[1]);
                $optionandvalue = str_replace('--', '', $this->args[1]);

                $arr = explode('=', $optionandvalue);

                $this->option = $arr[0] ?? '';
                $this->value = $arr[1] ?? '';

                return;
            }

        }


    }
