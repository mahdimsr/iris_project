<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Agenda;
use App\Model\Event;
use App\Model\Meeting;
use App\Model\Task;
use Illuminate\Http\Request;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;


class AndroidController extends Controller
{
	public function getEvent($userId)
	{
		$data = [];

		$event = Event::all();
		$task  = Task::query()->where('userId', '=', $userId)->get();

		$data['task']  = $task;
		$data['event'] = $event;

		return $data;
	}



	public function getMeeting(Request $r)
	{
		$agenda = Agenda::query()->with('meeting')->where('userId', $r->input('userId'))->get();

		return $agenda;
	}



	public function getMeetingDetails(Request $r)
	{
		$meeting = Meeting::with('agenda')->with('creator')->find($r->input('meetingId'));

		return $meeting;
	}



	public function setMeetingState(Request $r)
	{
		$agenda = Agenda::query()->where('meetingId', '=', $r->input('meetingId'))
			->where('userId', '=', $r->input('userId'))->update(['state' => $r->input('state')]);

		
		return 'SUCCESS';

	}



	public function setTask(Request $r)
	{

		$title       = $r->input('title');
		$description = $r->input('description');
		$userId      = $r->input('userId');
		$carbonDate  = CalendarUtils::createCarbonFromFormat('Y/m/d H:i:s', $r->input('date') . ' ' . $r->input('time'));

		$task = new Task();

		$task->userId      = $userId;
		$task->type        = 'PERSONAL';
		$task->title       = $title;
		$task->description = $description;
		$task->date        = $carbonDate;

		$task->save();

		return 'OK';
	}

}
