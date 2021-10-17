<?php

namespace apexx\modules\mediamanager\templatefunction;

class Icon extends \apexx\modules\core\IFunction
{
    public function execute(array $parameters): void
    {
        $extention = $parameters[0];
        $extention = \apexx\modules\core\Path::clean($extention);

        $filename = $this->module()->core()->path()->basedir() . "modules/mediamanager/icons/" . $extention . ".png";

        if( file_exists($filename) )
        {
            $this->assign("SRC", "index.php?module=mediamanager&action=icon&extention=".$extention);
            $this->assign("ALT", "file-icon-". $extention);
        }
        else
        {
            $this->assign("SRC", "index.php?module=mediamanager&action=icon&extention=unknown");
            $this->assign("ALT", "file-icon-unknwon");
        }

        $this->render("icon");
    }
}
