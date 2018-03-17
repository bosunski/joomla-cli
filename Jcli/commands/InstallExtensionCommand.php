<?php

    /**
     * DeleteFiles Command
     * I can let Modules handle checks.
     */

    class installExtensionCommand extends Command
    {
        public static $root = 'extension:install';

        public static $description = "Installs an extension from path or from url.";

        public $options = '';

        public function __construct()
        {
            parent::__construct();
        }

        public function doExecute()
        {
            // echo($this->input->option);
            // exit;
            $method = '';
            if ($this->input->option == 'url') {
                $method = 'url';
            } else if($this->input->option == 'path') {
                $method = 'folder';
            } else {
                $this->out("Option not Found");
                exit();
            }

             $installPackage = $this->input->value;
            $this->out(json_encode(array('result' => $this->installExtension($installPackage, $method))));
        }

        private function doChecks() {}

        /**
    	 * Installs an extension (From tmp_path or URL)
    	 *
    	 * @param   string  $filename
    	 * @param   string  $method
    	 *
    	 * @return  bool
    	 */
    	public function installExtension($filename, $method)
    	{
            $a = basename($filename);
            //echo $a;
            //exit($a);
    		if ($method == 'url')
    		{
    			$filename = JInstallerHelper::downloadPackage($filename);
    		}

    		$tmp_path = $this->app->get('tmp_path');
    		$path     = $tmp_path . '/' . basename($filename);
    		$package  = JInstallerHelper::unpack($filename, true);

    		if ($package['type'] === false)
    		{
    			return false;
    		}

    		$jInstaller = JInstaller::getInstance();
    		$result     = $jInstaller->install($package['extractdir']);
    		JInstallerHelper::cleanupInstall($path, $package['extractdir']);

    		return $result;
    	}

    }
