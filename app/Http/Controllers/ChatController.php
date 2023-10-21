<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ChatController extends Controller
{
    /**
     * get resource to display all chats
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        auth()->check();

        if (auth()->user()->role === 'A') {
            $users = User::all();
            $chats = Chat::all();
        } else {
            $chats = Chat::query()
                ->where('user_id', auth()->id())
                ->with(['user', 'messages'])
                ->latest()
                ->get();
        }

        $recipients = [];
        foreach ($chats as $chat) {
            $recipients[] = User::where('id', $chat->recipient_id)->first();
        }
        $admin = view()->shared('admin');

        return Inertia::render('Chats', [
            'chats' => $chats,
            'users' => $users ?? $admin,
            'recipients' => $recipients
        ]);
    }

    /**
     * Load resource to save a new chat and initial message
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        // validate
        $request->validate([
            'userId' => 'required',
            'message' => 'required',
            'recipientId' => 'required'
        ]);

        // create chat if it does not exist
        if ($request->input('chatId') !== null) {
            $chat = Chat::where('id',$request->input('chatId'))->first();
        } else {
            $chat = Chat::create([
                'user_id' => $request->input('userId') ?? auth()->id(),
                'recipient_id' => $request->input('recipientId'),
                'title' => $request->input('title') ?? null,
                'description' => $request->input('description') ?? null,
                'draft' => $request->input('draft') ?? false
            ]);
        }

        // create message
        $message = Message::create([
            'user_id' => $request->input('userId') ?? auth()->id(),
            'chat_id' => $chat->id,
            'recipient_id' => $request->input('recipientId'),
            'recipient_department' => $request->input('recipientDepartment') ?? 'admin',
            'message' => $request->input('message') ?? null,
            'is_read' => $request->input('isRead') ?? false
        ]);

        $chats = Chat::query()
            ->where('user_id', $chat->user_id)
            ->with(['user', 'messages'])
            ->oldest()
            ->get();

        if (auth()->user()->role === 'A') {
            $users = User::all();
            $chats = Chat::all();
        }
        $admin = view()->shared('admin');

        $recipients = [];
        foreach ($chats as $chat) {
            $recipients[] = User::where('id', $chat->recipient_id)->first();
        }

        return response()->json([
            'chats' => $chats,
            'users' => $users ?? $admin,
            'recipients' => $recipients
        ]);
    }

}
