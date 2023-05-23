<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\FolderUserController;
use App\Http\Controllers\UserController;
use App\Models\Folder;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('my-folders', [UserController::class,'myFolders']);
    Route::get('my-files/{folder}', [UserController::class,'myFiles']);
    Route::post('logout',[AuthController::class,'logout']);
    
    Route::get('folders',[FolderController::class,'index']);
    Route::get('folders/{id}',[FolderController::class,'show']);
    Route::get('folders/no-access/{id}',[FolderController::class,'noFolderAccess']);
    Route::post('new-folder',[FolderController::class,'store']);
    Route::post('folder-user/add-user',[FolderUserController::class,'folderUserAccess']);
    Route::post('files', [FileController::class,'store']);
    Route::post('status-file',[UserController::class,'updateStatusFile']);
});