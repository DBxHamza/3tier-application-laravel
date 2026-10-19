<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Message::latest('id')->limit(50)->get()->reverse()->values());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'author' => ['required', 'string', 'max:50'],
            'body' => ['required', 'string', 'max:500'],
        ]);

        $message = Message::create($data);

        return response()->json($message, 201);
    }
}
