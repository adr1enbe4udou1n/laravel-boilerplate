<?php

namespace App\Imports;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Files\ExcelFile;

class RedirectionListImport extends ExcelFile
{
    protected $delimiter = ';';

    /**
     * Get file.
     *
     * @return string
     */
    public function getFile()
    {
        /** @var UploadedFile $file */
        if ($file = Input::file('import')) {
            return $file->getPathname();
        }
    }
}
