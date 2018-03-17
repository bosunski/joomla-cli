<?php

    //if (file_exists('library/Command.php'))
    //{
    require_once('library/Command.php');
    require_once('library/JCliInput.php');
    //}
    /**
     *  Console Class
     */
    class Console
    {
        private static $instance;

        private $maps;

        private $commands;

        private function __construct()
        {
            $this->input = new JCliInput;
        }

        // Creates an Instance of the Console Class
        public static function getInstance()
        {
            if (!isset(self::$instance)) {
                $class = __CLASS__;
                $obj = new $class;
                self::$instance = $obj;
            }
            return self::$instance;
        }


        public function run()
        {
            $this->loadCommands();
            $this->registerCommands();
            return $this->execute();
            //$this->getArguments();
            //$this->getOptions();
        }

        public function registerCommands()
        {
            foreach ($this->maps as $classname => $path) {
                // Gets the description of commands
                $this->commands[$classname::$root]['description'] = $classname::$description;
                $this->commands[$classname::$root]['object'] = new $classname;
            }
        }

        public function execute()
        {
            foreach ($this->commands as $name => $details) {
                if($this->input->getCommand($name)) {
                    // We will Run the command
                    $details['object']->execute();

                    // We return a default exit status
                    return 2;
                }
            }

            // Command Not Found, We can display the command list
            echo "Command Not Found\n";
        }

        public function getOptions()
        {
            //
        }
        public function getArguments()
        {
            //
        }

        private function loadCommands()
        {
            $dir = JPATH_BASE . '/cli/Jcli/commands/';
            $pattern = '*';

            $files = glob($dir.$pattern);

            $this->maps = [];

            foreach ($files as $key => $fullpath) {
                $filename = explode($dir, $fullpath)[1];
                $classname = explode('.php', $filename)[0];
                $this->maps[$classname]['dir'] = $fullpath;

                require_once($fullpath);
            }

        }
    }
