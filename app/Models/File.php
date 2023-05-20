<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class File extends Model
{
    use HasFactory;

    /**
     * get the related object
     */
    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }

    /**
     * get the related object
     */
    public function statusUsers(): BelongsToMany
    {
        return $this->belongsToMany(Users::class, 'file_folder_user')
            ->withPivot('folder_id', 'status')
            ->withTimestamps();
    }

    /**
     * get the related object
     */
    public function statusFolders(): BelongsToMany
    {
        return $this->belongsToMany(Folders::class, 'file_folder_user')
            ->withPivot('user_id', 'status')
            ->withTimestamps();
    }
}
