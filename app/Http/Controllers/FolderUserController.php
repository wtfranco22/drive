<?php

namespace App\Http\Controllers;

use App\Models\FolderUser;
use Illuminate\Http\Request;

class FolderUserController extends Controller
{
    /**
     * log user access to folder
     */
    public function folderUserAccess(Request $request)
    {
        $this->authorize('folders');
        $request->validate([
            'id_user' => 'required',
            'id_folder' => 'required'
        ]);
        $newFolderUser = new FolderUser();
        $newFolderUser->user_id = $request->id_user;
        $newFolderUser->folder_id = $request->id_folder;
        if($newFolderUser->save()){
            $newFileFolderUser = new FileFolderUserController();
            $msg = ['success' => $newFileFolderUser->addUser($request->id_user,$request->id_folder)];
        }else{
            $msg = ['success' => false];
        }
        return response()->json([
            $msg]);
    }

    /**
     * verify users with access to the folder and update
     */
    public function addFile($folderId)
    {
        $users = FolderUser::where('folder_id', $folderId)
            ->where('status', 'complete')
            ->get();
        if (count($users) != 0) {
            // update user status on folder
            $usersId = [];
            foreach ($users as $user) {
                $usersId[] = $user->user_id;
                $user->status = 'in-progress';
                $user->save();
            }
            $msg = ['new-folder' => false, 'users' => $usersId];
        } else {
            $msg = ['new-folder' => true];
        }
        return $msg;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($folderId, $newStatus)
    {
        $statusFolder = FolderUser::where('user_id', auth()->user()->id)
            ->where('folder_id', $folderId)
            ->firstOrFail();
        $statusFolder->status = $newStatus;
        if ($statusFolder->save()) {
            $res = ['statusFolder' => $newStatus];
        } else {
            $res = ['statusFolder' => 'Error'];
        }
        return $res;
    }
}
