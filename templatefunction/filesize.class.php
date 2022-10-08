<?php

namespace apexx\modules\mediamanager\templatefunction;

class FileSize extends \apexx\modules\core\IFunction
{
    public function execute(array $parameters): void
    {
        $byte = $parameters[0];
        $types = ["B", "kB", "MB", "GB", "TB", "PB", "EB"];

        $t = 0;
        while( $byte > 1024 )
        {
            $byte /= 1024;
            $t++;
        }

        $this->assign("SIZE", sprintf( "%.1f", $byte ) );
        $this->assign("TYPE", $types[$t]);
        $this->render("filesize");
    }
}
