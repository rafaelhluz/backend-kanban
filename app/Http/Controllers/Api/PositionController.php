<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Position;

class PositionController extends Controller
{
    public function index()
    {
        return response()->json(Position::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'cod' => 'required|string|max:255',
            // 'desc' => 'required|string|max:255',
            // 'status' => 'required|string|max:1',
            'title' => 'required|string|max:255',
            'boards_id' => 'required|exists:boards,id',
            'position_order' => 'required|integer'
        ]);

        $position = Position::create($validated);

        return response()->json($position, 201);
    }

    public function show(string $id)
    {
        $position = Position::findOrFail($id);
        return response()->json($position);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            // 'cod' => 'required|string|max:255',
            // 'desc' => 'required|string|max:255',
            // 'status' => 'required|string|max:1',
            'title' => 'required|string|max:255',
            'boards_id' => 'required|exists:boards,id',
        ]);

        $position = Position::findOrFail($id);
        $position->update($validated);

        return response()->json($position);
    }

    public function destroy(string $id)
    {
        $position = Position::findOrFail($id);
        $position->delete();

        return response()->json(['message' => 'Tarefa deletada com sucesso']);
    }
}
