<?php

namespace App\Http\Controllers\Dashboard;

use App\Lib\Convert;
use App\Model\Meeting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Morilog\Jalali\CalendarUtils;


class MeetingController extends Controller
{
	public function view()
	{
		$meetings = Meeting::all();


		return view('meeting.view')->with('meetings',$meetings);
	}



	public function insertView()
	{
		return view('meeting.insert');
	}


	public function insert(Request $r)
	{
		$meetingDateConvert = Convert::convertNumber($r->input('meetingDate'));
		$meetingDate        = CalendarUtils::createDatetimeFromFormat('Y/m/d H:i:s', $meetingDateConvert);
		$title              = $r->input('title');
		$place              = $r->input('place');

		return $r;
	}
}
