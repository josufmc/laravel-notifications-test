<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use Illuminate\Http\Request;
use App\Notifications\MessageSent;
use Illuminate\Contracts\Auth\Factory as AuthFactory;

class MessagesController extends Controller
{
    protected $authFactory;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthFactory $authFactory)
    {
        $this->middleware('auth');

        $this->authFactory = $authFactory;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('id', '!=', $this->authFactory->id())->get();
        
        return view('home', compact('users'));
    }


    public function store(Request $request){
        $this->validate($request,[
            'body' => 'required',
            'recipient_id' => 'required|exists:users,id'
        ]);
        
        $message = Message::create([
            'sender_id' => $this->authFactory->id(),
            'recipient_id' => $request->recipient_id,
            'body' => $request->body,
        ]);

        $recipient = User::find($request->recipient_id);
        $recipient->notify(new MessageSent($message));

        return back()->with('flash', 'Tu mensaje fue enviado');
    }


    public function show($id)
    {
        $message = Message::findOrFail($id);
        return view('messages.show', compact('message'));
    }
}
