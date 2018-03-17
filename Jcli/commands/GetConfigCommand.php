<?php

    /**
     * GarbageCron Command
     */

    class GetConfigCommand extends Command
    {
        public static $root = 'config:get';

        public static $description = "Gets Specific Joomla! configuration.";

        public $options = '';

        public function __construct()
        {
            parent::__construct();
        }

        public function doExecute()
        {
            $config = $this->input->getOptionName();
            $valuep = $this->input->getOptionValue();

            $info = new stdClass();
            $value = JFactory::getApplication()->getCfg($config);
            $this->out("$config => $valuep");
        }


    }
