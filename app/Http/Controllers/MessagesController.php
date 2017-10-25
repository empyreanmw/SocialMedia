<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\Notifications\MessageNotifications;
use Illuminate\Validation\Rule;


class MessagesController extends Controller
{
	public function inbox(User $user)
	{
		$messages = $user->receivedMessages()->latest()->get();

		return view('profiles.messages', compact('messages', 'user'));
	}

	public function individualMessage(User $user, $messageId)
	{
		
		$this->removeMessageNotification($user, $messageId);
		$messages = Message::where('id', $messageId)->get();

		return view('profiles.messages', compact('messages', 'user'));
	}

	public function newMessage(User $user) //to do
	{
		$receivers = $user->receivedMessages()->where('sender_id', '!=', $user->id)->limit(5)->get();

		return view('profiles.messages.new-message', compact('user', 'receivers'));
	}

	public function store(User $user, Request $request)
	{
		$this->validate($request, [
			'name' => Rule::exists('users', 'name')->whereNot('name', $user->name),
			'body' => 'required'
		]);

		$receiver = User::findUserByName(request('name'));
		$message = Message::messageExist($receiver->id);

		if($message->exists())
		{		
			$message->get()[0]->createReply(request('body'));
		}
		else{
			$message = Message::create([
				'body' => request('body'),
				'sender_id' => auth()->user()->id,
				'receiver_id' => $receiver->id
			]);
		}

		$receiver->notify(new MessageNotifications($message->get()[0]->id));

		return redirect()->back()->with(['flash' => 'Your message has been sent!', 'type' => 'alert-success']);
		
	}

	public function createReply(User $user, Message $message)
	{
		$message->createReply(request('body'));

		$receiver = $message->sender_id == $user->id ? $message->receiver_id : $message->sender_id;

		User::find($receiver)->notify(new MessageNotifications($message->id));
		
		return redirect()->back()->with(['flash' => 'Your message has been sent!', 'type' => 'alert-success']);
	}

	public function removeMessageNotification($user, $messageId)
	{	
		$notifications = $user->notifications->where('type', 'App\Notifications\MessageNotifications');

		foreach($notifications as $notification)
		{
			if ($notification->data['id'] == $messageId)
			{
				$user->notifications()->where('id', $notification->id)->delete();
			}
		}
	}


}
