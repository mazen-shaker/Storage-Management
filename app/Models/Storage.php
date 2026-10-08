<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Export;


class Storage extends Model
{



 public function Export(){
    return $this->hasMany(Export::class);
   }
    protected $guarded = [];



    use HasFactory;
}
