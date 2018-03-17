<?php

    /**
     * GarbageCron Command
     */

    class SessionGcCommand extends Command
    {
        public static $root = 'sessiongc';

        public static $description = "CRON script to delete expired session data.";

        public $options = '';

        public function __construct()
        {
            parent::__construct();
        }

        public function doExecute()
        {
            JFactory::getSession()->gc();
            $this->out('All Done!');
        }


    }
