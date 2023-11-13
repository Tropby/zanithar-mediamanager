<?php

namespace apexx\modules\mediamanager\templatefunction;

class File extends \apexx\modules\core\IFunction
{
    public function execute(array $parameters): void
    {
        $filename = $parameters[0];
        echo $this->module()->core()->configuration()->get("root_directory")."index.php?module=mediamanager&action=file&filename=".$filename;
    }
}
