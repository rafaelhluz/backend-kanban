<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attach;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\FileBag;

class AttachController extends Controller
{
    public function index()
    {
        return response()->json(Attach::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_users' => 'required|exists:users,id',
            'id_tasks' => 'required|exists:tasks,id',
        ]);

        $attachesFiles = $this->handleAttach($request->file('file_url'), $validated['id_users'], $validated['id_tasks']);
        
        $attaches = [];

        foreach ($attachesFiles as $attachData) {
            $attaches[] = Attach::create($attachData);
        }

        return response()->json($attaches, 201);
    }

    private function handleAttach($files, int $id_users, int $id_tasks)
    {
        $attaches = [];

        foreach ($files as $file) {
            $path = $file->store('attachments/'. $id_tasks, 'local');

            $attaches[] = [
                'id_users' => $id_users,
                'id_tasks' => $id_tasks,
                'file_url' => Storage::disk('local')->path($path),
            ];
        }

        return $attaches;
    }

    public function show(string $id)
    {
        $attaches = Attach::find($id);

        if (!$attaches) {
            return response()->json(['message' => 'Anexo não encontrado'], 404);
        }

        return response()->json($attaches);

    }

    public function destroy(string $id)
    {
        $attach = Attach::find($id);

        if (!$attaches) {
            return response()->json(['message' => 'Anexo não encontrado'], 404);
        }

        $attaches->delete();
        return response()->json(['message' => 'Anexo deletado com sucesso']);
    }
}
