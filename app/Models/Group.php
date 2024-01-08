<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name','user_id_creater','files_count','file_size'];

    public function files()
    {
        return $this->hasMany(File::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
