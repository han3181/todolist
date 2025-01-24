<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'password',
    ];

    // Definisikan relasi dengan model Task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
