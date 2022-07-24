<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['Created'];

    public function getCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
