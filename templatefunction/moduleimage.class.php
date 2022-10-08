<?php

namespace apexx\modules\mediamanager\templatefunction;

class Moduleimage extends \apexx\modules\core\IFunction
{
    public function execute(array $parameters): void
    {
        $module = $parameters[0];
        $filename = $parameters[1];
        echo "?module=mediamanager&action=file&moduleImage=".$module."&filename=".$filename;
    }
}
