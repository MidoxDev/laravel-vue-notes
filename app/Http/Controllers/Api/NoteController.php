<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes= Auth::user()->notes()->get();

        return response()->json(compact('notes'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:200','unique:notes'],
            'description' => ['required', 'string'],
            'reminder_date' => ['required', 'date'],
            'priority' => ['required', 'string', 'max:200'],
            'permission' => ['required', 'string', 'max:200'],
        ]);

        Auth::user()->notes()->create([
            'title' => $request->title,
            'slug' => Str::slug( $request->title) . '-' . uniqid(),
            'description' => $request->description,
            'reminder_date' => $request->reminder_date,
            'priority' => $request->priority,
            'permission' => $request->permission,
            'pin' => false,
            'favourite' => false,
            'folder_id' => $request->folder_id,
        ]);

        return response()->json(['message'=>'New Note Created']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $note = Auth::user()->notes()->where('slug',$slug)->first();
        if (!$note) {
            return response()->json(status:404);
        }
        return response()->json(compact('note'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string'],
            'reminder_date' => ['required', 'date'],
            'priority' => ['required', 'string', 'max:200'],
            'permission' => ['required', 'string', 'max:200'],
        ]);

        Auth::user()->notes()->findOrFail($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'reminder_date' => $request->reminder_date,
            'priority' => $request->priority,
            'permission' => $request->permission,
            'pin' => false,
            'favourite' => false,
            'folder_id' => $request->folder_id,
        ]);

        return response()->json(['message'=>'Note Updated']);
    }

    function makeAsFavorite($id) {
        $note = Auth::user()->notes()->findOrFail($id);
        $note->update([
            'favourite' => !$note->favourite,
        ]);
        return response()->json(['message'=>'Note made as Favorite']);
    }

    function pin($id) {
        $note = Note::findOrFail($id);
        $note->update([
            'pin' => !$note->pin,

        ]);

        return response()->json(['message'=>'Note made as Favorite']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Auth::user()->notes()->findOrFail($id)->delete();
        return response()->json(['message'=>'Note Deleted']);
    }
}
