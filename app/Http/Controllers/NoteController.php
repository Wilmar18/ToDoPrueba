<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $user = Auth::guard('api')->user();
        $notes = Note::where('user_id', $user->id)->get();
        $success = true;
        $data = compact('notes');
        return compact('success', 'data');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'nullable|date',
            'tags' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::guard('api')->user();
        $note = new Note();
        $note->title = $request->title;
        $note->description = $request->description;
        $note->user_id = $user->id;
        $note->tags = $request->tags;
        $note->due_date = $request->due_date;

        if ($request->hasFile('image')) {
            $note->image = $request->file('image')->store('notes');
        }

        $note->save();

        $success = true;
        $data = compact('note');
        return compact('success', 'data');
    }

    public function show($id)
    {
        $user = Auth::guard('api')->user();
        $note = Note::where('user_id', $user->id)->find($id);

        if (!$note) {
            $success = false;
            $message = 'Nota no encontrada';
            return compact('success', 'message');
        }

        $success = true;
        $data = compact('note');
        return compact('success', 'data');
    }

    public function update(Request $request, $id)
    {

        $user = Auth::guard('api')->user();
        $note = Note::where('user_id', $user->id)->find($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'nullable|date',
            'tags' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $note->title = $request->title;
        $note->description = $request->description;
        $note->tags = $request->tags;
        $note->due_date = $request->due_date;

        if ($request->hasFile('image')) {
            $note->image = $request->file('image')->store('notes');
        }
        $note->save();

        $success = true;
        $data = compact('note');
        return compact('success', 'data');
    }

    public function destroy($id)
    {
        $user = Auth::guard('api')->user();
        $note = Note::where('user_id', $user->id)->find($id);

        if (!$note) {
            $success = false;
            $message = 'Nota no encontrada';
            return compact('success', 'message');
        }

        $note->delete();
        $success = true;
        return compact('success');
    }
    public function mostrar()
    {
        $user = auth()->user();
        $notes = $user->notes; // Asumiendo que tienes una relación de `notes` definida en el modelo `User`
        return response()->json(['success' => true, 'data' => $notes], 200);
    }
}
