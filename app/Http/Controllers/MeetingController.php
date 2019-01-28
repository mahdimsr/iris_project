<?php

namespace App\Http\Controllers;

use App\Lib\Convert;
use App\Model\Agenda;
use App\Model\Meeting;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Morilog\Jalali\CalendarUtils;


class MeetingController extends Controller {
    public function view() {
        $meetings = Meeting::all();
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

        $meeting = new Meeting();
        $Agendas = [];
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
            foreach ($user->task as $task) {
                $taskDate = Carbon::createFromFormat('Y-m-d H:i:s', $task->date);

                $taskDateEquals = Carbon::create($taskDate->year, $taskDate->month, $taskDate->day, $taskDate->hour);

                if ($meetingDateEquals->eq($taskDateEquals)) {
                    return redirect()->back()->with('userDuplicate', $user->name);
                } else {
                    $meeting->title = $r->input('meetingTitle');
                    $meeting->place = $r->input('meetingPlace');
                    $meeting->creatorId = 1;
                    $meeting->date = $meetingDate;

                    $meeting->save();
                    foreach ($Agendas as $agenda_item) {
                        $agenda = new Agenda();

                        $agenda->meetingId = $meeting->id;
                        $agenda->userId = $agenda_item['user'];
                        $agenda->title = $agenda_item['title'];
                        $agenda->value_time = $agenda_item['valueTime'];

                        $agenda->save();
                    }

                }

            }
        }

        return redirect(route('meetings'))->with('success', 'جلسه با موفقیت اضافه شد.');

    }


    public function remove(Meeting $Meeting) {

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
        $meeting = Meeting::find($r->input('meeting_id'));
        $Agendas = [];
        $meetingDateConvert = Convert::convertNumber($r->input('meetingDate'));
        $meetingDate = CalendarUtils::createCarbonFromFormat('Y/m/d H:i:s', $meetingDateConvert);
        if ($r->input('user') != null) {
            for ($i = 0; $i < count($r->input('user')); $i++) {
                $Agendas[$i]['user'] = $r->input('user')[$i];
                $Agendas[$i]['title'] = $r->input('title')[$i];
                $Agendas[$i]['valueTime'] = $r->input('time')[$i];
            }
        }
        $meeting->title = $r->input('meetingTitle');
        $meeting->place = $r->input('meetingPlace');
        $meeting->creatorId = 1;//todo After Creating User Controller
        $meeting->date = $meetingDate;
        $meeting->save();
        foreach ($meeting->agenda as $item) {
            $agenda = Agenda::find($item->id);
            $agenda->delete();
        }
        foreach ($Agendas as $agenda_item) {
            $agenda = new Agenda();

            $agenda->meetingId = $meeting->id;
            $agenda->userId = $agenda_item['user'];
            $agenda->title = $agenda_item['title'];
            $agenda->value_time = $agenda_item['valueTime'];

            $agenda->save();
        }
        return redirect()->back()->with('success', 'جلسه با موفقیت ویرایش شد.');
    }

    function Show(Meeting $Meeting){
        $Agendas = $Meeting->agenda;
        return view('meeting.show', [
            'Meeting' => $Meeting,
            'Agendas' => $Agendas
        ]);
    }
}
