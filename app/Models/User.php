<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * get the related object
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * get the related object
     */
    public function statusFolders(): BelongsToMany
    {
        return $this->belongsToMany(Folder::class, 'folder_user')
            ->withPivot('status')
            ->withTimestamps();
    }

    /**
     * get the related object
     */
    public function statusFiles(): BelongsToMany
    {
        return $this->belongsToMany(Folder::class, 'file_folder_user')
            ->withPivot('file_id', 'status')
            ->withTimestamps();
    }

    /**
     * get the related object
     */
    public function statusFilesFolders(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'file_folder_user')
            ->withPivot('folder_id', 'download')
            ->withTimestamps();
    }
}
