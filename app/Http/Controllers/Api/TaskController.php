<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tasks;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json(Tasks::all());
    }

    public function show(string $id)
    {
        $task = Tasks::find($id);

        if (!$task) {
            return response()->json(['message' => 'Tarefa não encontrada'], 404);
        }

        return response()->json($task);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'id_users' => 'required|exists:users,id',
            'id_positions' => 'required|exists:positions,id',
            'asign_user' => 'nullable|string|max:255',
            'dt_start' => 'nullable|date',
            'dt_end' => 'nullable|date',
        ]);

        $task = Tasks::create($validated);

        return response()->json($task, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'id_users' => 'required|exists:users,id',
            'id_positions' => 'required|exists:positions,id',
            'dt_start' => 'nullable|date',
            'dt_end' => 'nullable|date',
        ]);

        $task = Task::findOrFail($id);
        $task->update($validated);

        return response()->json($task);
    }

    public function destroy(string $id)
    {
        $task = Tasks::find($id);

        if (!$task) {
            return response()->json(['message' => 'Tarefa não encontrada'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Tarefa deletada com sucesso']);
    }
}
