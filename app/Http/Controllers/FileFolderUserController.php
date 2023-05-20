<?php

namespace App\Http\Controllers;

use App\Models\FileFolderUser;
use App\Models\Folder;
use Illuminate\Http\Request;

class FileFolderUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * update user status on new file
     */
    public function addUser($userId, $folderId)
    {
        $files = Folder::find($folderId)->files;
        $countFiles = 0;
        foreach ($files as $file) {
            $addFileFolderUser = new FileFolderUser();
            $addFileFolderUser->user_id = $userId;
            $addFileFolderUser->folder_id = $folderId;
            $addFileFolderUser->file_id = $file->id;
            ($addFileFolderUser->save()) ? $countFiles++ : $countFiles;
        }
        return ['success' => true]; // all registered
    }

    /**
     * update user status on new file
     */
    public function addFile($fileId, $folderId, $idUsers)
    {
        $countUsers = 0;
        foreach ($idUsers as $idUser) {
            $addFileFolderUser = new FileFolderUser();
            $addFileFolderUser->user_id = $idUser;
            $addFileFolderUser->file_id = $fileId;
            $addFileFolderUser->folder_id = $folderId;
            ($addFileFolderUser->save()) ? $countUsers++ : $countUsers;
        }
        return ['success' => $countUsers == count($idUsers)]; // all registered
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($fileId, $folderId)
    {
        /**
         * buscamos tupla del archivo, registramos la descarga
         * siempre registramos desde la primera a ultima descarga para el
         * estado del usuario sobre la carpeta
         */
        $file = FileFolderUser::where('user_id', auth()->user()->id)
            ->where('file_id', $fileId)
            ->firstOrFail();
        $file->download = true;
        if ($file->save()) {
            $statusFolder = FileFolderUser::where('user_id', auth()->user()->id)
                ->where('folder_id', $folderId)
                ->where('download', 0)
                ->get();
            $status = (count($statusFolder) != 0) ? 'in-process' : 'complete';
            $updateStatusFolder = new FolderUserController();
            $msgFolder = $updateStatusFolder->update($folderId, $status);
            $msgFile = ['statusFile' => true];
        } else {
            $msgFile = ['statusFile' => 'Error'];
        }
        return [$msgFile, $msgFolder];
    }
}
