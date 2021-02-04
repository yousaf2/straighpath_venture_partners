<?php


namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function md5;
use function microtime;

class FileUploadService
{
    public static function upload(UploadedFile $file,$path = 'files')
    {
        $name = md5(microtime()).'.'.$file->getClientOriginalExtension();

        $file->storeAs($path,$name);
        $file->uploaded_name = $name;
        $file->uploaded_path = $path;

        return $file;
    }

    public static function delete($filename, $path = 'files/')
    {   

        if ( Storage::exists($path.$filename) ){
            Storage::delete($path.$filename);
        }

        return true;
    }
}
