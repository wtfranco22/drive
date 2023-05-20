<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function myfolders()
    {
        $folders = User::find(auth()->user()->id)->statusFolders;
        return response()->json([
            'status' => 1,
            'folders' => $folders
        ], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function myFiles($folder)
    {
        $folders = User::find(auth()->user()->id)->statusFilesFolders
        ->where('folder_id',$folder);
        return $folders;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function updateStatusFile(Request $request)
    {
        $request->validate([
            'id_file' => 'required',
            'id_folder' => 'required'
        ]);
        $updateStatusFile = new FileFolderUserController();
        $res = $updateStatusFile->update($request->id_file,$request->id_folder);
        return response()->json([
            $res
        ]);
    }
}
