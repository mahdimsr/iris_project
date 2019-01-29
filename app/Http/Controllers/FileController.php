<?php

namespace App\Http\Controllers;
use App\Model\File;
use Illuminate\Http\Request;
use Response;
use DB;
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

    public function accept(File $File) {
        if (DB::table('user_file')->where([
            ['user_id', auth()->user()->id],
            ['file_id', $File->id],
        ])->exists()){
            DB::table('user_file')->where([
                ['user_id', auth()->user()->id],
                ['file_id', $File->id],
            ])->update([
               'is_approved'    => true
            ]);
        }else{
            DB::table('user_file')->insert([
                'is_approved'    => true,
                'user_id'        => auth()->user()->id,
                'file_id'        => $File->id
            ]);
        }
        $Agendas = $File->meeting->agenda;
        $FinalFileState = false;
        foreach ($Agendas as $agenda) {
            $AgendaUserID = $agenda->user->id;
            if (DB::table('user_file')->where([
                ['user_id', $AgendaUserID],
                ['file_id', $File->id],
                ['is_approved' , true]
            ])->exists()){
                $FinalFileState = true;
            }else{
                $FinalFileState = false;
            }
        }

        $File->is_approved = $FinalFileState;
        $File->save();
        return redirect()->back()->with('status' , 'فایل تائید شد.');
    }

    public function reject(File $File) {
        if (DB::table('user_file')->where([
            ['user_id', auth()->user()->id],
            ['file_id', $File->id],
        ])->exists()){
            DB::table('user_file')->where([
                ['user_id', auth()->user()->id],
                ['file_id', $File->id],
            ])->update([
                'is_approved'    => false
            ]);
        }else{
            DB::table('user_file')->insert([
                'is_approved'    => false,
                'user_id'        => auth()->user()->id,
                'file_id'        => $File->id
            ]);
        }
        $Agendas = $File->meeting->agenda;
        $FinalFileState = false;
        foreach ($Agendas as $agenda) {
            $AgendaUserID = $agenda->user->id;
            if (DB::table('user_file')->where([
                ['user_id', $AgendaUserID],
                ['file_id', $File->id],
                ['is_approved' , true]
            ])->exists()){
                $FinalFileState = true;
            }else{
                $FinalFileState = false;
            }
        }

        $File->is_approved = $FinalFileState;
        $File->save();
        return redirect()->back()->with('status' , 'فایل رد شد.');

    }
}
