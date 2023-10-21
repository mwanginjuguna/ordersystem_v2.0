<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MessageController extends Controller
{
    /**
     * Display a listing of the messages belonging to a specific user.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        auth()->check();

        if (auth()->user()->role === 'A') {
            $messages = Message::with('user')
                ->latest()
                ->get();

        } else {
            // Retrieve the messages belonging to the specified user with their relations
            $messages = Message::with('user')
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        }

        $recipients = [];

        // get the recipients of all the messages
        foreach ($messages as $message) {
            $recipient = User::where('id', $message->to)->first();
            $recipients[] = $recipient;
        }

        // Return the messages as a JSON response
        // return response()->json(['messages' => $messages]);
        return Inertia::render('ClientOrders/Messages', [
            'messages' => $messages,
            'recipients' => $recipients
        ]);
    }

    /**
     * Display a listing of the messages belonging to a specific user.
     *
     * @param Request $request
     * @param Chat $chat
     * @return JsonResponse
     */
    public function showMessages(Request $request, Chat $chat): JsonResponse
    {
        $user = User::where('id', $chat->user_id)->first();

        // Retrieve the messages belonging to the specified user with their relations
        $messages = Message::query()
            ->with('user')
            ->where('chat_id', $chat->id)
            ->oldest()
            ->get();

        $recipients = [];

        // get the recipients of all the messages
        foreach ($messages as $message) {
            $recipient = User::where('id', $message->recipient_id)->first();
            $recipients[] = $recipient;
        }

        // Return the messages as a JSON response
        return response()->json([
            'chat' => $chat,
            'user' => $user,
            'messages' => $messages,
            'recipients' => $recipients
        ]);
    }

    /**
     * Store a newly created message in storage and return all messages by the user.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function store(Request $request, User $user): JsonResponse
    {
        // Validate the request data
        $validatedData = $request->validate([
            'message' => 'required',
            'recipient_id' => 'required',
        ]);

        // Create a new message instance
        $message = Message::create([
            'user_id' => $user->id,
            'recipient_id' => $request->input('recipient_id') ?? User::query()
                    ->where('role', 'A')
                    ->pluck('id')
                    ->first(),
            'recipient_department' => $request->input('recipient_department') ?? 'admin',
            'message' => $request->input('message')
        ]);

        // Retrieve all messages by the user with their relations
        $messages = $user->role === 'A' ? Message::with('user')->latest()->get() : $user->messages()->with('user')->latest()->get();

        // Return all messages by the user as a JSON response
        return response()->json(['messages' => $messages]);
    }
}
