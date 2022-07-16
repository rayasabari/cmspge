<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;

    protected $with = ['type'];
    
    public function type()
    {
        return $this->belongsTo(ElementType::class, 'element_type_id')->select('id','name','slug');
    }
}
