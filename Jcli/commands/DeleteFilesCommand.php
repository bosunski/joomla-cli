<?php

    /**
     * DeleteFiles Command
     */

    class DeleteFilesCommand extends Command
    {
        public static $root = 'deletefiles';

        public static $description = "attempt to remove files that should have been deleted at update.";

        public $options = '';

        public function __construct()
        {
            parent::__construct();
        }

        public function doExecute()
        {
            // Import the dependencies
            jimport('joomla.filesystem.file');
            jimport('joomla.filesystem.folder');

            // We need the update script
            JLoader::register('JoomlaInstallerScript', JPATH_ADMINISTRATOR . '/components/com_admin/script.php');

            // Instantiate the class
            $class = new JoomlaInstallerScript;

            // Run the delete method
            $class->deleteUnexistingFiles();

            $this->out("Completed!");
        }

    }
