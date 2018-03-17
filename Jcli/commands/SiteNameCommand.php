<?php

    /**
     * Site Command
     */
    
    class SiteNameCommand extends Command
    {
        public static $root = 'sitename';

        public static $description = "Gets the SiteNAme";

        public $options = '';

        public function __construct()
        {
            parent::__construct();
        }

        public function doExecute()
        {
            $info = new stdClass();
            $info->sitename = JFactory::getApplication()->getCfg('sitename');

            $comment = $this->input->getOptionValue('comment');
            if($comment != '' && $comment == 'yes')
            {
                $this->out('<comment>'.json_encode($info).'</comment>');
                return;
            }
            $this->out(json_encode($info));

        }


    }
