<?php

namespace App\Http\Controllers\Dashboard;

use App\Lib\Convert;
use App\Model\Agenda;
use App\Model\Meeting;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Morilog\Jalali\CalendarUtils;


class MeetingController extends Controller
{
	public function view()
	{
		$meetings = Meeting::all();


		return view('meeting.view')->with('meetings', $meetings);
	}



	public function insertView()
	{
		$users = User::with('post')->get();

		return view('meeting.insert')->with('users', $users);
	}



	public function insert(Request $r)
	{
		$r->validate([

			'meetingTitle' => 'required|max:30',
			'meetingPlace' => 'required|max:20',
			'meetingDate'  => 'required',

		]);

		$meeting = new Meeting();

		$meetingDateConvert = Convert::convertNumber($r->input('meetingDate'));
		$meetingDate        = CalendarUtils::createCarbonFromFormat('Y/m/d H:i:s', $meetingDateConvert);
		$title              = $r->input('title');
		$place              = $r->input('place');

		$meeting->title     = $r->input('meetingTitle');
		$meeting->place     = $r->input('meetingPlace');
		$meeting->creatorId = 1;
		$meeting->date      = $meetingDate;

		$meeting->save();

		for ($i = 0; $i < count($r->input('user')); $i++)
		{
			$agenda = new Agenda();

			$agenda->meetingId  = $meeting->id;
			$agenda->userId     = $r->input('user')[$i];
			$agenda->title      = $r->input('title')[$i];
			$agenda->value_time = $r->input('valueTime')[$i];

			$agenda->save();
		}

		return redirect()->action('Dashboard\\MeetingController@view');

	}



	public function remove(Request $r)
	{
		$meeting = Meeting::query()->find($r->input('id'));

		$meeting->delete();

		return redirect()->back();
	}



	public function editView($id)
	{
		$meeting = Meeting::with('agenda')->find($id);

		return $meeting;
	}
}
