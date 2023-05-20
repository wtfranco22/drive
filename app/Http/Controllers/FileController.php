<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('folders');
        $request->validate([
            'id_folder' => 'required',
            'name' => 'required',
            'format' => 'required'
        ]);
        $newFile = new File();
        $newFile->folder_id = $request->id_folder;
        $newFile->name = $request->name;
        $newFile->url = 'url-archivo-a-generar';
        $newFile->format = $request->format;
        if ($newFile->save()) {
            // register new states, responsibility-->FolderUserController
            $updateFolderUser = new FolderUserController();
            $msg = $updateFolderUser->addFile($request->id_folder);
            if (!$msg['new-folder']) {
                // file in a folder with users, register new states,responsibility-->FileFolderUserController
                $updateFileUser = new FileFolderUserController();
                $msgUpdate = $updateFileUser->addFile($newFile->id, $request->id_folder, $msg['users']);
            } else {
                $msgUpdate = ['success' => true];
            }
        } else {
            $msgUpdate = ['success' => false];
        }
        return response()->json([$msgUpdate]);
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        //
    }
}
