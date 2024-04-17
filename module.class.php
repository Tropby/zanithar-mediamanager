<?php

namespace apexx\modules\mediamanager;

use apexx\modules\core\EXECUTION_TYPE;

class Module extends \apexx\modules\core\IModule
{
    public function __construct(\apexx\modules\core\Core $core)
    {
        parent::__construct(
            $core,
            "mediamanager",
            "2.0.0"
        );

        // Register all template functions
        $this->registerAction("show", EXECUTION_TYPE::ADMIN);
        $this->registerAction("upload", EXECUTION_TYPE::ADMIN, false);
        $this->registerAction("del", EXECUTION_TYPE::ADMIN, false);
        $this->registerAction("ImageGallery", EXECUTION_TYPE::ADMIN, false);

        $this->registerTemplateFunction("filesize");
        $this->registerTemplateFunction("icon");
        $this->registerTemplateFunction("moduleImage");
        $this->registerTemplateFunction("file");
        
        $this->registerAction("file", EXECUTION_TYPE::PUBLIC);
        $this->registerAction("icon", EXECUTION_TYPE::PUBLIC);
    }

    public function startup() : void
    {
    }

    public function htaccess(): array
    {
        return [
            "RewriteRule ^media/modules/([^/]*)/(.*)$ index.php?module=mediamanager&action=file&moduleImage=$1&filename=$2 [L]",
            "RewriteRule ^media/(.*)$ index.php?module=mediamanager&action=file&filename=$1 [L]",
            "RewriteRule ^(.*)/media/(.*)$ index.php?module=mediamanager&action=file&filename=$2 [L]"
        ];
    }
    
}
