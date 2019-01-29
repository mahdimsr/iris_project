<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Agenda;
use App\Model\Event;
use App\Model\Meeting;
use App\Model\Message;
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
		$task  = Task::query()->with('meeting')->where('userId', '=', $userId)->get();

		$data['task']  = $task;
		$data['event'] = $event;

		return $data;
	}



	public function getMeeting(Request $r)
	{

		$agenda = Agenda::query()->with([
			'meeting' => function($query) use ($r)
			{
				if ($r->has('state'))
				{
					$query->where('state', '=', $r->input('state'));
				}

				if ($r->has('title'))
				{
					$query->where('title', 'like', '%' . $r->input('title') . '%');
				}

				if ($r->has('number'))
				{
					$query->where('id', '=', $r->input('number'));
				}

				if ($r->has('dateFrom') && $r->has('dateTo'))
				{
					$carbonDateFrom = CalendarUtils::createCarbonFromFormat('Y/m/d H:i:s', $r->input('dateFrom') . ' 00:00:00');
					$carbonDateTo   = CalendarUtils::createCarbonFromFormat('Y/m/d H:i:s', $r->input('dateTo') . ' 00:00:00');

					$query->where('date', '>=', $carbonDateFrom)->where('date', '<=', $carbonDateTo);
				}
			},
		])->where('userId', $r->input('userId'))->get();


		return $agenda;
	}



	public function getMeetingDetails(Request $r)
	{
		$meeting = Meeting::with('agenda')->with('creator')->find($r->input('meetingId'));

		$agenda = Agenda::query()->where('meetingId', '=', $meeting->id)
			->where('userId', '=', $r->input('userId'))->get();

		$data['meeting'] = $meeting;
		$data['agenda']  = $agenda;

		return $data;
	}



	public function setMeetingState(Request $r)
	{
		Agenda::query()->where('meetingId', '=', $r->input('meetingId'))
			->where('userId', '=', $r->input('userId'))->update(['state' => $r->input('state')]);


		$meeting = Meeting::query()->find($r->input('meetingId'));

		foreach ($meeting->agenda as $agenda)
		{
			if ($agenda->state == 'ACCEPTED')
			{
				$meeting->state = 'ON';
			}
			else if ($agenda->state == 'CANCELED')
			{
				$meeting->state = 'CANCEL';
				$meeting->update();
				return 'SUCCESS';
			}
			else
			{
				$meeting->state = 'SUSPEND';
				$meeting->update();
				return 'SUCCESS';

			}

		}

		$meeting->update();


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



	public function getMessage(Request $r)
	{
		$message = Message::query()->where('receiver_id', '=', $r->input('receiverId'))->with([
			'sender' => function($query) use ($r)
			{
				if ($r->has('senderId'))
				{
					$query->where('sender_id', '=', $r->input('senderId'));
				}
			},
		]);

		if ($r->has('state'))
		{
			$message->where('is_read', '=', $r->input('state'));
		}

		if ($r->has('title'))
		{
			$message->where('title', 'like', '%' . $r->input('title') . '%');
		}


		return $message->get();
	}

}
