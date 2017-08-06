<?php

namespace App\Imports;

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
        if ($import = Input::get('import')) {
            $data = explode(',', $import);

            $tmpfname = tempnam(sys_get_temp_dir(), 'import');
            $handle = fopen($tmpfname, 'wb');
            fwrite($handle, base64_decode($data[1]));
            fclose($handle);

            return $tmpfname;
        }

        return null;
    }
}
