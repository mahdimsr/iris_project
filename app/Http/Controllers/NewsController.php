<?php

namespace App\Http\Controllers;

use App\Model\Message;
use App\Model\User;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function sendView() {
        return view('news.send');
    }

    public function send(Request $request) {
        $Receivers = User::all();
        $Title = $request->input('title');
        $Content = $request->input('content');
        $current_user = auth()->user()->id;
        foreach ($Receivers as $Receiver){
            $Message = new Message();
            $Message->title = $Title;
            $Message->content = $Content;
            $Message->sender_id = $current_user;
            $Message->receiver_id = $Receiver->id;
            $Message->is_read = false;
            $Message->is_news = true;
            $Message->save();
        }
        return redirect()->back()->with('success' , 'خبر ارسال شد');

    }

    public function list() {
        $messages = Message::query()->where([
            ['is_news', true],
            ['receiver_id' , auth()->user()->id]
        ])->paginate(15);

        return view('news.list')->with('messages', $messages);
    }

    public function show(Message $Message) {
        $Message->is_read = true;
        $Message->save();

        return view('news.show')->with('Message', $Message);
    }
}
