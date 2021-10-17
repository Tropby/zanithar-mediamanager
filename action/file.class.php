<?php

namespace apexx\modules\mediamanager\action;

class File extends \apexx\modules\core\IAction
{
    public function execute(): void
    {
        $filename = $this->module()->core()->param()->get("filename");
        $filename = \apexx\modules\core\Path::clean($filename);

        if( file_exists( $this->module()->core()->path()->basedir()."uploads/".$filename ) )
        {
            // Clean the output buffer and send the requested file
            ob_end_clean();

            $filename = $this->module()->core()->path()->basedir() . "uploads/" . $filename;

            header("content-type: ". mime_content_type($filename));
            header("content-length: ". filesize($filename));

            $handle = fopen($filename, "rb");
            echo stream_get_contents($handle);
            fclose($handle);
            exit;
        }
        else
        {
            die("File '".$filename."' does not exist!");
        }
    }
}
