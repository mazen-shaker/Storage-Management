<?php

namespace App\Models;
use App\Models\Export;
use App\Models\Operation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Dep extends Model
{   
    use HasFactory;   
    protected $guarded = [];
    public function Export()
    {
        return $this->hasMany(related: Export::class);
    }

    public function Operation()
    {
        return $this->hasMany(related: Operation::class);
    }
}
