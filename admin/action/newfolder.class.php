<?php

namespace apexx\modules\mediamanager\admin\action;

use stdClass;

class NewFolder extends \apexx\modules\core\IAction
{
    public function execute(): void
    {
        $path = $this->module()->core()->param()->get("path");
        $file = $this->module()->core()->param()->file("fileUpload");

        $path = \apexx\modules\core\Path::clean($path);

        mkdir($path);
    }
}
