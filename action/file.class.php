<?php

namespace apexx\modules\mediamanager\action;

class File extends \apexx\modules\core\IAction
{
    public function execute(): void
    {
        if( !$this->module()->core()->param()->getIf("filename") )
        {
            die("Filename not set!");
        }

        $filename = $this->module()->core()->param()->get("filename");
        $filename = \apexx\modules\core\Path::clean($filename);

        if( $this->param()->getIf("moduleImage") )
        {
            $moduleImage = $this->param()->get("moduleImage");
            $moduleImage = \apexx\modules\core\Path::clean($moduleImage);
            if(  strpos($moduleImage, "/") !== false )
            {
                throw new \Exception("module name contains illigal characters!");
            }

            $filename = $this->module()->core()->path()->basedir() . "modules/".$moduleImage."/images/" . $filename;
        }
        elseif( $this->param()->getIf("moduleFile") )
        {
            $moduleFile = $this->param()->get("moduleFile");
            $moduleFile = \apexx\modules\core\Path::clean($moduleFile);
            if(  strpos($moduleFile, "/") !== false )
            {
                throw new \Exception("module name contains illigal characters!");
            }

            $filename = $this->module()->core()->path()->basedir() . "modules/".$moduleFile."/files/" . $filename;
        }
        else
        {
            $filename = $this->module()->core()->path()->basedir() . "uploads/" . $filename;
        }

        $this->sendFile($filename);
    }

    private function sendFile(string $filename)
    {
        if( file_exists( $filename ) )
        {
            // Clean the output buffer and send the requested file
            ob_end_clean();

            header("content-type: ". mime_content_type($filename));
            header("content-length: ". filesize($filename));
            header('pragma: public');
            header('cache-control: max-age=86400');
            header('expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + 86400));

            echo file_get_contents($filename);
            exit;
        }
        else
        {
            die("File '".$filename."' does not exist!");
        }
    }
}
