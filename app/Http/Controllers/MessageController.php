<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Message;
class MessageController extends Controller {
    //
    public function sendView() {
        return view('message.send');
    }

    public function receiveListView() {
        $messages = Message::query()->where('receiver_id',auth()->user()->id)->paginate(15);
        return view('message.receiveList')->with('messages', $messages);
    }

    public function sendListView() {
        $messages = Message::query()->where('sender_id',auth()->user()->id)->paginate(15);
        return view('message.sendList')->with('messages', $messages);

    }

    public function send(Request $request) {
        $Receivers = $request->input('receiver');
        $Title = $request->input('title');
        $Content = $request->input('content');
        $current_user = auth()->user()->id;
        $Receivers = array_unique($Receivers);
        foreach ($Receivers as $Receiver){
            $Message = new Message();
            $Message->title = $Title;
            $Message->content = $Content;
            $Message->sender_id = $current_user;
            $Message->receiver_id = $Receiver;
            $Message->is_read = false;
            $Message->save();
        }


        return redirect()->back()->with('success' , 'پیام(ها) ارسال شدند');
    }

    public function show(Message $Message) {
        $Message->is_read = true;
        $Message->save();



        return view('message.show')->with('Message', $Message);

    }
}
