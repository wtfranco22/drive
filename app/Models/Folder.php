<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Folder extends Model
{
    use HasFactory;

    /**
     * get the related object
     */
    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    /**
     * get the related object
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'folder_user')
        ->withPivot('status')
        ->withTimestamps();
    }
}
