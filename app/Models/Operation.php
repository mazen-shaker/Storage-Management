<?php

namespace App\Models;
use App\Models\Dep;
use App\Models\Export;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model   
{     
    use HasFactory;

    protected $guarded = [];  



public function Dep()    
{
    return $this->belongsTo(related: Dep::class);
}

public function Export()  
{
    return $this->belongsTo(related: Export::class);
}
    
}
   