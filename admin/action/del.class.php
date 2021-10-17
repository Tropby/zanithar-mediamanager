<?php

namespace apexx\modules\mediamanager\admin\action;

class Del extends \apexx\modules\core\IAction
{
    public function execute(): void
    {
        $path = "";
        if ($this->module()->core()->param()->getIf("filename"))
            $path = $this->module()->core()->param()->get("filename");
        $path = \apexx\modules\core\Path::clean($path);
        $path = $this->module()->core()->path()->basedir() . "uploads/" . $path;

        if (file_exists($path))
            unlink($path);
    }
}
