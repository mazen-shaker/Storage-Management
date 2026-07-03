<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Prev extends Model
{
    use HasFactory;

    public function User()
    {
        return $this->hasMany(related: User::class);
    }
}
