<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        return response()->json(Comment::all());
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_users' => 'exists:users,id',
            'id_tasks' => 'exists:tasks,id',
            'description' => 'string|max:255',
        ]);

        $comment = Comment::create($validated);

        return response()->json($comment, 201);
    }
    public function show(string $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comentário não encontrado'], 404);
        }

        return response()->json($comment);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'id_users' => 'exists:users,id',
            'id_tasks' => 'exists:tasks,id',
            'description' => 'string|max:255',
        ]);

        $comment = Comment::find($id);
        
        if (!$comment) {
            return response()->json(['message' => 'Comentário não encontrado'], 404);
        }

        $comment->update($validated);

        return response()->json($comment);
    }

    public function destroy(string $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comentário não encontrado'], 404);
        }

        $comment->delete();

        return response()->json(['message' => 'Comentário deletado com sucesso']);
    }
}
