<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadFile
{

    public function uploadPicture($file, $path)
    {

        $path = $file->store($path);

        if($path)
            return true;
        else
            return false;
    }
}
