<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Model\Message;
use Illuminate\Http\Request;

class StaticsController extends Controller {


    function index(){
        $News = Message::query()->where([
            ['is_news' , true],
            ['is_read' , false],
            ['receiver_id' , auth()->user()->id]
        ])->latest()->take(5)->get();

        $Messages = Message::query()->where([
            ['is_news' , false],
            ['is_read' , false],
            ['receiver_id' , auth()->user()->id]
        ])->latest()->take(5)->get();


        return view('static', [
            'Messages' => $Messages,
            'News' => $News,
        ]);
    }
}
