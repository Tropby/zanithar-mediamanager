<?php

namespace apexx\modules\mediamanager\action;

class Icon extends \apexx\modules\core\IAction
{
    public function execute(): void
    {
        $filename = $this->module()->core()->param()->get("extention");
        $filename = \apexx\modules\core\Path::clean($filename);

        $filename = $this->module()->core()->path()->basedir() . "modules/mediamanager/icons/" . $filename . ".png";
        if (file_exists($filename))
        {
            // Clean the output buffer and send the requested file
            ob_end_clean();

            header("content-type: " . mime_content_type($filename));
            header("content-length: " . filesize($filename));

            $handle = fopen($filename, "rb");
            echo stream_get_contents($handle);
            fclose($handle);
            exit;
        }
        else
        {
            die("Icon '" . $filename . "' does not exist!");
        }
    }
}
