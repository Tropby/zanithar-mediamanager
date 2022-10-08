<?php

namespace apexx\modules\mediamanager\templatefunction;

class Moduleimage extends \apexx\modules\core\IFunction
{
    public function execute(array $parameters): void
    {
        $module = $parameters[0];
        $filename = $parameters[1];
        echo $this->module()->core()->configuration()->get("root_directory")."media/modules/".$module."/".$filename;
    }
}
