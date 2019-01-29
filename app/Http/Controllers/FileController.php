<?php

namespace App\Http\Controllers;
use App\Model\File;
use Illuminate\Http\Request;
use Response;
class FileController extends Controller
{
    public function getDownload(File $File){
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . $File->path;
        $name = time() .'.'. $File->ext;
        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, $name, $headers);
    }
}
