<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('folders');
        $folders = Folder::all();
        return response()->json([
            'status' => 1,
            'folders' => $folders
        ], 200);
    }

    public function noFolderAccess($id){
        $this->authorize('folders');
        $users = User::whereDoesntHave('statusFolders', function ($query) use ($id) {
            $query->where('folder_id', $id);
        })->whereHas('role', function ($query) {
            $query->where('name', 'user');
        })->get();
        return response()->json([
            'status'=>1,
            'users'=>$users
        ],200);
    }


    /**
     * new folder
     */
    public function store(Request $request)
    {
        $this->authorize('folders');
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_date' =>'required',
            'end_date' =>'required'
        ]);
        $newFolder = new Folder();
        $newFolder->name = $request->name;
        $newFolder->description = $request->description;
        $dateObjStart = DateTime::createFromFormat("d-m-Y", $request->start_date);
        $dateObjEnd = DateTime::createFromFormat("d-m-Y", $request->end_date);
        $newFolder->start_date = $dateObjStart->format("Y-m-d");
        $newFolder->end_date = $dateObjEnd->format("Y-m-d");
        $newFolder->url = 'prueba de la url solicitada';
        return response()->json(['success' =>  $newFolder->save()]);
    }

    public function show($id)
    {
        $this->authorize('folders');
        $users=[];
        $folder = Folder::find($id);
        foreach($folder->users as $user){
            $countDownload = $user->statusFiles()->where('download',1)->count();
            $users[] = ['user'=>$user,'download'=>$countDownload];
        }
        return response()->json([
            'status' => 1,
            'users'=>$users,
            'files' =>$folder->files

        ], 200);
    }
}
