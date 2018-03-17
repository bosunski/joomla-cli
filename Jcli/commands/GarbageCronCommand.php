<?php

    /**
     * GarbageCron Command
     */

    class GarbageCronCommand extends Command
    {
        public static $root = 'garbagecron';

        public static $description = "cron job to trash expired cache data.";

        public $options = '';

        public function __construct()
        {
            parent::__construct();
        }

        public function doExecute()
        {
            $cache = JFactory::getCache();
    		$cache->gc();
            $this->out('Completed!');
        }


    }
