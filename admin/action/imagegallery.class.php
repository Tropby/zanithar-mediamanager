<?php

namespace apexx\modules\mediamanager\admin\action;

use stdClass;

class ImageGallery extends \apexx\modules\core\IAction
{
    public function execute(): void
    {
        $path = $this->module()->core()->param()->get("path");
        $path = "uploads/".$path;
        $path = $this->module()->core()->path()->clean($path);

        $result = new stdClass();

        $dir = scandir($path);
        $images = [];
        foreach( $dir as $d )
        {
            if(!is_file($path."/".$d) || $d[0] == ".")
            {
                continue;
            }

            $image = new stdClass();
            $image->src = "index.php?module=mediamanager&action=file&path=$path&filename=$d";
            $image->name = $d;
            $image->alt = $d;
            $image->tag = "";
            $images[] = $image;
        }

        $result->result = $images;
        $result->nullMessage = "Nothing here!";
        $result->errorMessage = "Error!";
        ob_end_clean();
        echo json_encode($result);
        die();
    }
}
