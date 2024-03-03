<?php

namespace apexx\modules\mediamanager\admin\action;

class Del extends \apexx\modules\core\IAction
{
    public function execute(): void
    {
        $path = "";
        if ($this->module()->core()->param()->getIf("filename") && $this->module()->core()->param()->getIf("path"))
        {
            $path = $this->module()->core()->param()->get("path");
            $cleanPath = $path;
            $path .= "/";
            $path .= $this->module()->core()->param()->get("filename");
        }
        else
        {
            throw new \apexx\modules\core\Exception("Filename or Path not set!");
        }
        $path = \apexx\modules\core\Path::clean($path);

        $path = $this->module()->core()->path()->basedir() . "uploads/" . $path;

        if (file_exists($path))
        {
            unlink($path);
        }
        else
        {
            throw new \apexx\modules\core\Exception("Can not delete file. File $path does not exist!");
        }

        $this->module()->core()->redirectAction("mediamanager", "show", ["path" => $cleanPath]);
    }
}
