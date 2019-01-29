<?php

namespace App\Http\Controllers;

use App\Lib\Convert;
use App\Model\Agenda;
use App\Model\File;
use App\Model\Meeting;
use App\Model\Task;
use App\Model\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Morilog\Jalali\CalendarUtils;

class MeetingController extends Controller {
    public function view() {
        $current_user = auth()->user()->id;
        $PostID = auth()->user()->postId;
        if ($PostID == 3) {
            $meetings = Meeting::paginate(15);
        } else {
            $meetings = Meeting::query()->whereIn('id' , function ($query){
                $query->select('meetingId')->from('agenda')->where('userId' , auth()->user()->id);
            })->paginate(15);
        }

        return view('meeting.view')->with('meetings', $meetings);
    }


    public function insertView() {
        $users = User::with('post')->get();
        return view('meeting.insert')->with('users', $users);
    }


    public function insert(Request $r) {
        /*$r->validate([

            'meetingTitle' => 'required|max:30',
            'meetingPlace' => 'required|max:20',
            'meetingDate'  => 'required',

        ]);*/
        $current_user = auth()->user()->id;
        $meeting = new Meeting();
        $Agendas = [];
        if ($r->input('user') == null) {
            return redirect()->back()->with('agenda_error', 'حداقل یک کاربر اضافه کنید.');
        }
        for ($i = 0; $i < count($r->input('user')); $i++) {
            $Agendas[$i]['user'] = $r->input('user')[$i];
            $Agendas[$i]['title'] = $r->input('title')[$i];
            $Agendas[$i]['valueTime'] = intval(Convert::convertNumber($r->input('valueTime')[$i]));
        }
        $meetingDateConvert = Convert::convertNumber($r->input('meetingDate'));
        $meetingDate = CalendarUtils::createCarbonFromFormat('Y/m/d H:i:s', $meetingDateConvert);
        $meetingDateEquals = Carbon::create($meetingDate->year, $meetingDate->month, $meetingDate->day, $meetingDate->hour);
        for ($i = 0; $i < count($r->input('user')); $i++) {
            $user = User::query()->find($r->input('user')[$i]);
            if (count($user->task) > 0) {
                foreach ($user->task as $task) {
                    $taskDate = Carbon::createFromFormat('Y-m-d H:i:s', $task->date);

                    $taskDateEquals = Carbon::create($taskDate->year, $taskDate->month, $taskDate->day, $taskDate->hour);
                    if ($meetingDateEquals->eq($taskDateEquals)) {
                        return redirect()->back()->with('userDuplicate', $user->name);
                    } else {

                        $meeting->title = $r->input('meetingTitle');
                        $meeting->place = $r->input('meetingPlace');
                        $meeting->creatorId = $current_user;
                        $meeting->date = $meetingDate;

                        $meeting->save();
                        foreach ($Agendas as $agenda_item) {
                            $agenda = new Agenda();

                            $agenda->meetingId = $meeting->id;
                            $agenda->userId = $agenda_item['user'];
                            $agenda->title = $agenda_item['title'];
                            $agenda->value_time = $agenda_item['valueTime'];

                            $agenda->save();

                            $title = 'جلسه ' . $meeting->title;
                            $description = 'جلسه ' . $meeting->place . 'برگزار می‌شود.';
                            $userId = $agenda->userId;
                            $carbonDate = $meetingDate;
                            $task = new Task();

                            $task->userId = $userId;
                            $task->type = 'PERSONAL';
                            $task->title = $title;
                            $task->description = $description;
                            $task->date = $carbonDate;

                            $task->save();
                        }

                    }

                }

            } else {
                $meeting->title = $r->input('meetingTitle');
                $meeting->place = $r->input('meetingPlace');
                $meeting->creatorId = $current_user;
                $meeting->date = $meetingDate;

                $meeting->save();
                foreach ($Agendas as $agenda_item) {
                    $agenda = new Agenda();

                    $agenda->meetingId = $meeting->id;
                    $agenda->userId = $agenda_item['user'];
                    $agenda->title = $agenda_item['title'];
                    $agenda->value_time = $agenda_item['valueTime'];

                    $agenda->save();

                    $title = $meeting->title;
                    $description = 'جلسه در ' . $meeting->place . ' برگزار می‌شود.';
                    $userId = $agenda->userId;
                    $carbonDate = $meetingDate;

                    $task = new Task();

                    $task->userId = $agenda_item['user'];
                    $task->title = $title;
                    $task->description = $description;
                    $task->meetingId = $meeting->id;
                    $task->type = 'MEETING';
                    $task->date = $carbonDate;

                    $task->save();
                }
            }

        }
        return redirect(route('meetings'))->with('success', 'جلسه با موفقیت اضافه شد.');

    }


    public function remove(Meeting $Meeting) {
        $Agendas = $Meeting->agenda;
        foreach ($Agendas as $Agenda) {
            $Agenda->delete();
        }
        $Meeting->delete();

        return redirect()->back()->with('success', 'جلسه با موفقیت حذف شد.');
    }


    public function editView(Meeting $Meeting) {
        $Agendas = $Meeting->agenda;
        $Users = User::with('post')->get();
        return view('meeting.edit', [
            'Meeting' => $Meeting,
            'Agendas' => $Agendas,
            'Users' => $Users
        ]);
    }

    public function edit(Request $r) {
        $current_user = auth()->user()->id;
        $meeting = Meeting::find($r->input('meeting_id'));
        $Agendas = [];
        if ($r->input('user') == null) {
            return redirect()->back()->with('agenda_error', 'حداقل یک کاربر اضافه کنید.');
        }
        for ($i = 0; $i < count($r->input('user')); $i++) {
            $Agendas[$i]['user'] = $r->input('user')[$i];
            $Agendas[$i]['title'] = $r->input('title')[$i];
            $Agendas[$i]['valueTime'] = intval(Convert::convertNumber($r->input('time')[$i]));
        }


        foreach ($meeting->agenda as $item) {
            $item->delete();
        }
        DB::table('task')->where('meetingId' , $r->input('meeting_id'))->delete();
        $meetingDateConvert = Convert::convertNumber($r->input('meetingDate'));
        $meetingDate = CalendarUtils::createCarbonFromFormat('Y/m/d H:i:s', $meetingDateConvert);
        $meetingDateEquals = Carbon::create($meetingDate->year, $meetingDate->month, $meetingDate->day, $meetingDate->hour);
        $user_request = array_unique($r->input('user'));
        $user_request = array_combine(range(0, count($user_request) - 1), array_values($user_request));
        for ($i = 0; $i < count($user_request) - 1; $i++) {
            $UserIsFree = false;
            $user = User::query()->find((int)$user_request[$i]);
            if (count($user->task) > 0) {
                foreach ($user->task as $task) {
                    $taskDate = Carbon::createFromFormat('Y-m-d H:i:s', $task->date);
                    $taskDateEquals = Carbon::create($taskDate->year, $taskDate->month, $taskDate->day, $taskDate->hour);
                    if ($meetingDateEquals->eq($taskDateEquals)) {
                        return redirect(route('meetings-edit' , $r->input('meeting_id')))->with('userDuplicate', $user->name);
                    } else {
                        $UserIsFree = true;
                    }
                }

            } else {
                $UserIsFree = false;
                $meeting->title = $r->input('meetingTitle');
                $meeting->place = $r->input('meetingPlace');
                $meeting->creatorId = $current_user;
                $meeting->date = $meetingDate;

                $meeting->save();
                foreach ($Agendas as $agenda_item) {
                    $agenda = new Agenda();

                    $agenda->meetingId = $meeting->id;
                    $agenda->userId = $agenda_item['user'];
                    $agenda->title = $agenda_item['title'];
                    $agenda->value_time = $agenda_item['valueTime'];

                    $agenda->save();

                    $title = $meeting->title;
                    $description = 'جلسه در ' . $meeting->place . ' برگزار می‌شود.';
                    $userId = $agenda->userId;
                    $carbonDate = $meetingDate;

                    $task = new Task();

                    $task->userId = $userId;
                    $task->type = 'PERSONAL';
                    $task->title = $title;
                    $task->description = $description;
                    $task->meetingId = $meeting->id;
                    $task->type = 'MEETING';
                    $task->date = $carbonDate;

                    $task->save();
                }
            }
            if ($UserIsFree){
                $meeting->title = $r->input('meetingTitle');
                $meeting->place = $r->input('meetingPlace');
                $meeting->creatorId = $current_user;
                $meeting->date = $meetingDate;

                $meeting->save();
                foreach ($Agendas as $agenda_item) {
                    $agenda = new Agenda();

                    $agenda->meetingId = $meeting->id;
                    $agenda->userId = $agenda_item['user'];
                    $agenda->title = $agenda_item['title'];
                    $agenda->value_time = $agenda_item['valueTime'];

                    $agenda->save();

                    $title = $meeting->title;
                    $description = 'جلسه در ' . $meeting->place . ' برگزار می‌شود.';
                    $userId = $agenda->userId;
                    $carbonDate = $meetingDate;

                    $task = new Task();

                    $task->userId = $userId;
                    $task->type = 'PERSONAL';
                    $task->title = $title;
                    $task->description = $description;
                    $task->meetingId = $meeting->id;
                    $task->type = 'MEETING';
                    $task->date = $carbonDate;

                    $task->save();
                }
            }

        }

        return redirect()->back()->with('success', 'جلسه با موفقیت ویرایش شد.');
    }

    function Show(Meeting $Meeting) {
        $FilesFinal = DB::table('file')->where([
            ['meeting_id', $Meeting->id],
            ['type', 'FINAL'],
        ])->get()
        ;

        $FilesDoc = DB::table('file')->where([
            ['meeting_id', $Meeting->id],
            ['type', 'DOC'],
        ])->get()
        ;

        $Agendas = $Meeting->agenda;
        return view('meeting.show', [
            'Meeting' => $Meeting,
            'Agendas' => $Agendas,
            'FilesFinal' => $FilesFinal,
            'FilesDoc' => $FilesDoc,
        ]);
    }

    function Document(Meeting $Meeting, Request $r) {
        $filepath = public_path() . '/files';
        $file = $r->docfile;
        $file_name = $r->input('doc-name');
        $file_type = $r->input('doc_final');
        if ($file_type == 'true') {
            $file_type = "FINAL";
        } else {
            $file_type = "DOC";
        }
        $current_user = auth()->user()->id;

        $file_url = '/files/' . time() . '.' . $file->getClientOriginalExtension();
        $file->move($filepath, time() . '.' . $file->getClientOriginalExtension());
        $File = new File();
        $File->name = $file_name;
        $File->path = $file_url;
        $File->ext = $file->getClientOriginalExtension();
        $File->type = $file_type;
        $File->meeting_id = $Meeting->id;
        $File->uploader_id = $current_user;
        $File->save();
        return redirect()->back()->with('status', 'فایل با موفقیت آپلود شد');
    }
}
