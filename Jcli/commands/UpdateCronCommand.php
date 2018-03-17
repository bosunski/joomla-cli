<?php

    /**
     * GarbageCron Command
     */

    class UpdateCronCommand extends Command
    {
        public static $root = 'updatecron';

        public static $description = "This is update Cron.";

        public $options = '';

        public function __construct()
        {
            parent::__construct();
        }

        public function doExecute()
        {
            // Get the update cache time
    		$component = JComponentHelper::getComponent('com_installer');

    		$params = $component->params;
    		$cache_timeout = $params->get('cachetimeout', 6, 'int');
    		$cache_timeout = 3600 * $cache_timeout;

    		// Find all updates
    		$this->out('Fetching updates...');
    		$updater = JUpdater::getInstance();
    		$updater->findUpdates(0, $cache_timeout);
    		$this->out('Finished fetching updates');
        }


    }
