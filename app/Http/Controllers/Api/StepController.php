<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Step;

class StepController extends Controller
{
    public function index()
    {
        return response()->json(Step::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'completed' => 'nullable|boolean|max:1',
            'description' => 'nullable|string',
            'id_users' => 'required|exists:users,id',
            'id_tasks' => 'required|exists:positions,id',
        ]);

        $step = Step::create($validated);

        return response()->json($step, 201);
    }

    public function show(string $id)
    {
        $step = Step::find($id);

        if (!$step) {
            return response()->json(['message' => 'Tarefa não encontrada'], 404);
        }

        return response()->json($step);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'completed' => 'required|string|max:1',
            'description' => 'nullable|string',
            'id_users' => 'required|exists:users,id',
            'id_tasks' => 'required|exists:positions,id',
        ]);

        $step = Step::find($id);
        
        if (!$step) {
            return response()->json(['message' => 'Tarefa não encontrada'], 404);
        }

        $step->update($validated);

        return response()->json($step);

    }

    public function destroy(string $id)
    {
        $step = Step::find($id);

        if (!$step) {
            return response()->json(['message' => 'Tarefa não encontrada'], 404);
        }

        $step->delete();

        return response()->json(['message' => 'Tarefa deletada com sucesso']);
    }
}
