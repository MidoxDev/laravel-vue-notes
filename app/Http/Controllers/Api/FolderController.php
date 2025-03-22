<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    function index() {
        $folders = Auth::user()->folders()->get();
        return response()->json(compact('folders'));
    }

    function store(Request $request){
        $request->validate([
            'title' => ['required', 'string', 'max:200','unique:folders'],
        ]);

        Auth::user()->folders()->create([
            'title' => $request->title,
        ]);

        return response()->json(['message'=>'New Note Created']);
    }

    function update(Request $request,$id) {
        $folder = Auth::user()->folders()->findOrFail($id);

        $request->validate([
            'title' => ['required', 'string', 'max:200','unique:folders'],
        ]);

        $folder->update([
            'title' => $request->title
        ]);

        return response()->json(['message'=>'Note Updated']);
    }

    function destroy($id) {
        Auth::user()->folders()->findOrFail($id)->delete();
        return response()->json(['message'=>'Note Deleted']);
    }
}
