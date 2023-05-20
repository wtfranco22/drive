<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FolderUser extends Pivot
{
    protected $table = 'folder_user';

    protected $fillable = [
        'folder_id',
        'user_id',
        'status'
    ];

    /**
     * get the related object
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }

    /**
     * get the related object
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
