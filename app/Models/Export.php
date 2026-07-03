<?php

namespace App\Models;
use App\Models\Operation;
use App\Models\Storage;
use App\Models\Dep;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Export extends Model   
{
    protected $guarded = [];


public function Dep()    
{
    return $this->belongsTo(related: Dep::class);
}

public function Storage(){                   
    return $this->belongsTo(Storage::class); 
}

public function Operation()
{
    return $this->hasMany(related: Operation::class);
}
  
    use HasFactory;
}
