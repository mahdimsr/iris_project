<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Event;
use Illuminate\Http\Request;

class AndroidController extends Controller
{
	public function getEvent()
	{
		$event = Event::all();

		return $event;
    }
}
