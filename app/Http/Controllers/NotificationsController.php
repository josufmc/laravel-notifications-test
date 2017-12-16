<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Contracts\Auth\Factory as AuthFactory;

class NotificationsController extends Controller
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
    public function index()
    {
        $unreadNotifications = $this->authFactory->user()->unreadNotifications;   // No leidas
        $readNotifications = $this->authFactory->user()->readNotifications;       // Leidas

        return view('notifications.index', [
            'unreadNotifications' => $unreadNotifications,
            'readNotifications' => $readNotifications
        ]);
    }

    public function read($id){
        $notification = DatabaseNotification::find($id);
        $notification->markAsRead();
        return back()->with('flash', 'Notificación marcada como leída');
    }

    public function destroy($id){
        $notification = DatabaseNotification::find($id);
        $notification->delete();
        return back()->with('flash', 'Notificación eliminada');
    }
}
