<?php

    /**
     * GarbageCron Command
     */

    class UpdateCoreCommand extends Command
    {
        public static $root = 'update:core';

        public static $description = "Updates the Joomla! Core.";

        public $options = '';

        public function __construct()
        {
            parent::__construct();
        }

        public function doExecute()
        {
            JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_installer/models');
    		$this->updater = JModelLegacy::getInstance('Update', 'InstallerModel');
            $this->out(json_encode(array('700' => $this->updateCore())));
        }


        /**
         * Update Core Joomla
         *
         * @return  bool  success
         */
        public function updateCore()
        {
            JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_joomlaupdate/models');
            $jUpdate = JModelLegacy::getInstance('Default', 'JoomlaupdateModel');

            $jUpdate->purge();

            $jUpdate->refreshUpdates(true);

            $updateInformation = $jUpdate->getUpdateInformation();

            if (!empty($updateInformation['hasUpdate']))
            {
                $packagefile = JInstallerHelper::downloadPackage($updateInformation['object']->downloadurl->_data);
                $tmp_path    = $this->app->get('tmp_path');
                $packagefile = $tmp_path . '/' . $packagefile;
                $package     = JInstallerHelper::unpack($packagefile, true);
                JFolder::copy($package['extractdir'], JPATH_BASE, '', true);

                $result = $jUpdate->finaliseUpgrade();

                if ($result)
                {
                    // Remove the xml
                    if (file_exists(JPATH_BASE . '/joomla.xml'))
                    {
                        JFile::delete(JPATH_BASE . '/joomla.xml');
                    }

                    JInstallerHelper::cleanupInstall($packagefile, $package['extractdir']);

                    return true;
                }
            }

            return false;
        }


    }
