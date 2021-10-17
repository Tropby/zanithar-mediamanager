<?php

namespace apexx\modules\mediamanager\admin\action;

use stdClass;

class Upload extends \apexx\modules\core\IAction
{
    public function execute(): void
    {
        $path = $this->module()->core()->param()->get("path");
        $file = $this->module()->core()->param()->file("fileUpload");

        $path = \apexx\modules\core\Path::clean($path);
        
        $result = new stdClass();

        if( !$file )
        {
            header('HTTP/1.1 403 Forbidden');
            $result->message = "file upload failed!";
            $result->error = true;
            die(json_encode($result));
        }

        if( !is_dir($this->module()->core()->path()->basedir() . "uploads/" . $path) )
        {
            mkdir( $this->module()->core()->path()->basedir() . "uploads/".$path, 0777, true );
        }

        if (move_uploaded_file($file["tmp_name"], 
            $this->module()->core()->path()->basedir() . "uploads/".$path . "/" . basename($file["name"])))
        {
            $result->message = "upload okay!";
            $result->reloadUrl = "?";
            $result->url = "index.php?module=mediamanager&action=file&filename=" . $path . "/" . basename($file["name"]);
            die(json_encode($result));
        }
        else
        {
            header('HTTP/1.1 403 Forbidden');
            $result->message = "can not move file to upload folder!";
            $result->error = true;
            
            die(json_encode($result));
        }
    }
}
