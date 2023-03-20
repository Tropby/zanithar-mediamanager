<?php

namespace apexx\modules\mediamanager\admin\action;

class Show extends \apexx\modules\core\IAction
{
    public function execute(): void
    {
        $path = "";
        if ($this->module()->core()->param()->getIf("path"))
            $path = $this->module()->core()->param()->get("path");
        $path = \apexx\modules\core\Path::clean($path);

        $this->assign("FILE_LIST", $this->listFiles("uploads/" . $path, $path));
        $this->assign("DIR_LIST", $this->listDirectories("uploads/" . $path, $path));
        $this->assign("CURRENT_PATH", $path);

        $pathList = [];
        foreach (explode("/", $path) as $p)
        {
            $pathList[] = [
                "NAME" => $p
            ];
        }
        $this->assign("PATH_LIST", $pathList);

        if( $this->module()->core()->param()->getIf("adminMenu") && $this->module()->core()->param()->getInt("adminMenu") )
        {
            // Clean the output buffer and send the requested file
            ob_end_clean();
            $this->assign("STANDALONE", true);            
            $this->render("show");
            die();
        }
        else
        {
            $this->assign("STANDALONE", false);
            $this->render("show");
        }
    }

    private function listDirectories(string $directory, string $path): array
    {
        $directory = \apexx\modules\core\Path::clean($directory);

        $result = [];

        $files = scandir($directory);

        foreach ($files as $file)
        {
            if ($file[0] == ".")
                continue;

            if (is_file($directory . "/" . $file))
                continue;

            $result[] = [
                "NAME" => $file,
                "SIZE" => 0,
                "EXTENTION" => "folder"
            ];
        }

        return $result;
    }

    private function listFiles(string $directory, string $path): array
    {
        $directory = \apexx\modules\core\Path::clean($directory);

        $result = [];

        $files = scandir($directory);
        foreach ($files as $file)
        {
            if ($file[0] == ".")
                continue;

            if (!is_file($directory . "/" . $file))
                continue;

            $extention = explode(".", $file);
            $extention = $extention[count($extention) - 1];

            $result[] = [
                "NAME" => $file,
                "DIRECTORY" => $path,
                "SIZE" => filesize($directory . "/" . $file),
                "EXTENTION" => $extention
            ];
        }

        return $result;
    }
}
