<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Models\NotificationPreference;
use App\Models\Notifydb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Notifications extends Controller
{
    public function notify()
    {
        $uname = Auth::user()->uname;

        $unread = Notifydb::forUser($uname)->unread()->latest()->get();
        $read   = Notifydb::forUser($uname)->read()->latest()->paginate(20);
        $pref   = NotificationPreference::forUser(Auth::id());

        return view('dash.notifications', compact('unread', 'read', 'pref'));
    }

    public function markRead(Notifydb $notification)
    {
        $this->authorise($notification);
        $notification->markRead();
        return back()->with('success', 'Notification marked as read.');
    }

    public function markAllRead()
    {
        $uname = Auth::user()->uname;
        Notifydb::forUser($uname)->unread()->update(['status' => 'read']);
        return back()->with('success', 'All notifications marked as read.');
    }

    public function destroy(Notifydb $notification)
    {
        $this->authorise($notification);
        $notification->delete();
        return back()->with('success', 'Notification deleted.');
    }

    public function savePreferences(Request $request)
    {
        $request->validate([
            'in_app' => ['nullable', 'boolean'],
            'email'  => ['nullable', 'boolean'],
        ]);

        NotificationPreference::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'in_app' => $request->boolean('in_app'),
                'email'  => $request->boolean('email'),
            ]
        );

        return back()->with('success', 'Notification preferences saved.');
    }

    // Private 

    private function authorise(Notifydb $notification): void
    {
        $uname = Auth::user()->uname;
        abort_if(
            $notification->to !== $uname && $notification->to !== 'all',
            403
        );
    }
}