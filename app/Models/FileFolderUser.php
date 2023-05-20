<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FileFolderUser extends Pivot
{
    protected $table = 'file_folder_user';

    protected $fillable = [
        'file_id',
        'folder_id',
        'user_id',
        'download'
    ];

    /**
     * get the related object
     */
    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }

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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
