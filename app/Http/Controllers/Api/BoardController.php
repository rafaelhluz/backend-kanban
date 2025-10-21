<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Board;

class BoardController extends Controller
{
    
    public function index()
    {
        return response()->json(Board::all());
    }

    
    public function show(string $id)
    {
        $board = Board::find($id);

        if (!$board) {
            return response()->json(['message' => 'Board not found'], 404);
        }

        return response()->json($board);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $board = Board::create($validated);

        return response()->json($board, 201);
    }

    public function update(Request $request, string $id)
    {   
        $validated = $request->validate([
            'title' => 'string|max:255',
        ]);

        $board = Board::find($id);
        
        if (!$board) {
            return response()->json(['message' => 'Board not found'], 404);
        }

        $board->update($validated);

        return response()->json($board);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $board = Board::find($id);

        if (!$board) {
            return response()->json(['message' => 'Board not found'], 404);
        }

        $board->delete();

        return response()->json(['message' => 'Board deleted successfully']);
    }
}
